<?php
namespace App\Repositories\Contracts\Base;

interface ReadableColumnInterface{
    public function getAccessibleColumn();
    public function getFillableColumn();
}
