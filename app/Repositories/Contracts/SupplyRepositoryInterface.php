<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface SupplyRepositoryInterface extends BaseRepositoryInterface{
    public function getEnumStatusSupply();
    public function getEnumStatusSupplyWait();

    public function linkHistoryToSupply($supply,$history);
}
