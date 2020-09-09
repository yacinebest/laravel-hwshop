<?php

namespace App\Models;

use Carbon\Carbon;

class Supply extends BaseModel
{

    //
    protected $appends =['productName','hasBeenUsed'];
    protected $enumStatus = ['WAITING','IN PROGRESS','CANCELED','COMPLETED'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function history()
    {
        return $this->belongsTo('App\Models\History');
    }

/*
|---------------------------------------------------------------------------|
| GETTER & SETTER                                                           |
|---------------------------------------------------------------------------|
*/

    public function getProductNameAttribute(){
        return $this->product->name;
    }

    public function getSupplyDateAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getStartedAtAttribute($value){
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'Not Yet';
    }

    public function getEndedAtAttribute($value){
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'Not Yet';
    }

    public function getHasBeenUsedAttribute(){
        return $this->status==$this->enumStatus[2] || $this->status==$this->enumStatus[3] ;
    }

    public function getIsCompletedAttribute(){
        return $this->status == 'COMPLETED';
    }

    public function getIsProgressAttribute(){
        return $this->status == 'IN PROGRESS';
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/
    public function changeStat($stat){
        $current_time = now()->format('Y-m-d H:m:s');
        $this->update(['status'=>$stat]);
        switch ($stat) {
            case ($stat=='CANCELED')://canceled
            case ($stat=='COMPLETED')://completed
                $this->updateRelat($current_time,false);
            break;

            case ($stat=='IN PROGRESS')://in progress
                $this->updateRelat($current_time,true);
            break;
            default:
            break;
        }
    }

    private function updateRelat($date,$in_progress){
        $data = $in_progress ? ['started_at'=>$date] : ['ended_at'=>$date];

        $this->update($data);
        $this->history()->update($data);

        if($in_progress)
            $data_product = ['copy_number'=>$this->quantity,'price'=>$this->history->selling_price];
        else
            $data_product = ['copy_number'=>0,'price'=>0];

        $this->product()->update($data_product);
    }

    public function changeStatToInProgress(){
        $this->changeStat('IN PROGRESS');
    }

    public function changeStatToCompleted(){
        $this->changeStat('COMPLETED');
    }
}
