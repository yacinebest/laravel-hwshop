<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\HistoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplyRepositoryInterface;
use Illuminate\Http\Request;

class SupplyRepository extends BaseRepository implements SupplyRepositoryInterface{

    private $productRepository;
    private $historyRepository;

    public function __construct(ProductRepositoryInterface $productRepository,
                                HistoryRepositoryInterface $historyRepository) {
        $this->productRepository = $productRepository;
        $this->historyRepository = $historyRepository;
    }
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
            'started_at' => 'Started At',
            'ended_at' => 'Ended At',
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

    public function getEnumStatusSupplyWait(){
        return ['WAITING'];
    }

    public function linkHistoryToSupply($supply,$history){
        $this->update($supply,['history_id'=>$history->id]);
        // $supply->history()->associate($history);
        // $history->supply()->associate($supply);
    }

    public function updateChangeStatusWithRelat($status,$supply){
        $current_time = now()->format('Y-m-d H:m:s');
        switch ($status) {
            case ($this->getEnumStatusSupply())[2]://canceled
            case ($this->getEnumStatusSupply())[3]://completed
                $this->updateRelat($supply,$current_time,false);
            break;

            case ($this->getEnumStatusSupply())[1]://in progress
                $this->updateRelat($supply,$current_time,true);
            break;
            default:
            break;
        }
    }

    private function updateRelat($supply,$date,$in_progress){
        $data = $in_progress ? ['started_at'=>$date] : ['ended_at'=>$date];

        $this->update($supply,$data);
        $this->historyRepository->update($supply->history,$data);

        if($in_progress)
            $data_product = ['copy_number'=>$supply->quantity,'price'=>$supply->history->selling_price];
        else
            $data_product = ['copy_number'=>0,'price'=>0];

        $this->productRepository->update($supply->product,$data_product);

        // $this->update($supply,['ended_at'=>$current_time]);
        // $this->historyRepository->update($supply->history,['ended_at'=>$current_time]);
        // $this->productRepository->update($supply->product,['copy_number'=>0,'price'=>0]);

        // $this->update($supply,['started_at'=>$current_time]);
        // $this->historyRepository->update($supply->history,['started_at'=>$current_time]);
        // $this->productRepository->update($supply->product,
        //         ['copy_number'=>$supply->quantity,'price'=>$supply->history->selling_price]
        //     );

    }
}
