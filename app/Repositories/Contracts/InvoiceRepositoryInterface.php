<?php
namespace App\Repositories\Contracts;


interface InvoiceRepositoryInterface extends BaseRepositoryInterface  {
    public function createInvoice($order);
}
