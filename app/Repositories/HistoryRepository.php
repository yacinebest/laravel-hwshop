<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\HistoryRepositoryInterface;
use Illuminate\Http\Request;

class HistoryRepository extends BaseRepository implements HistoryRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'productName'=>'Product Name',
            'supplyRef'=>'Supply Ref',
            'selling_price'=>'Selling Price',
            'quantity' => 'quantity',
            'started_at' => 'Started At',
            'ended_at' => 'Ended At',
            'other'=>''
        ];
    }
}
