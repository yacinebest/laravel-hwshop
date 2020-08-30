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
            'productName'=>'Product Name',
            'admission_price'=>'Admission Price',
            'quantity' => 'quantity',
            'supply_date' => 'Supply Date',
        ];
    }
}