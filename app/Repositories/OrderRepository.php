<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'userUsername'=>'Order By',
            'adminUsername'=>'Verified By',
            'status'=>'Status',
            'order_date'=>'Order Date',
            'updated_at'=>'Updated At'
        ];
    }
}
