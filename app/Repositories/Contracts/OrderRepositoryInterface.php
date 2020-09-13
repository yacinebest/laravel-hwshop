<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface OrderRepositoryInterface extends BaseRepositoryInterface{
    public function getEnumStatusSupply();

    public function linkDeliveryToOrder($order,$delivery);
    public function linkPaymentToOrder($order,$payment);
    public function linkInvoiceToOrder($order,$invoice);

    public function getAccessibleColumnForShow();

    public function createOrder($user);
}
