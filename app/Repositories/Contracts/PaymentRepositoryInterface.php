<?php
namespace App\Repositories\Contracts;


interface PaymentRepositoryInterface extends BaseRepositoryInterface  {
    public function findPaymentByMethod($method);
}
