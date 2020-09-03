<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface OrderRepositoryInterface extends BaseRepositoryInterface{
    public function getEnumStatusSupply();

    public function linkDeliveryToOrder($order,$delivery);
}
