<?php
namespace App\Repositories\Contracts;

interface DeliveryRepositoryInterface extends BaseRepositoryInterface  {
    public function createDelivery($order);
}
