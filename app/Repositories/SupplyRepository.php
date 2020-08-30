<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class SupplyRepository extends BaseRepository implements SupplyRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'productName'=>'Supply For',
            'admission_price'=>'Admission Price',
            'quantity' => 'quantity',
            'status'=>'Status',
            'supply_date' => 'Supply Date',
            'updated_at' => 'Updated At',
            'other'=>''
        ];
    }

/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function getEnumStatusSupply(){
        return ['WAITING','IN PROGRESS','CANCELED','COMPLETED'];
    }
}