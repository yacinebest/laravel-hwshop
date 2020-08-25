<?php
namespace App\Repositories\Contracts\Base;

interface DeleteInterface{
    public function delete($entity);
    public function deleteImages($entity);
}
