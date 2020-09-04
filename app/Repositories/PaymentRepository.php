<?php
namespace App\Repositories;

use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface {

/*
|---------------------------------------------------------------------------|
| Override BaseRepository FUNCTION                                          |
|---------------------------------------------------------------------------|
*/
    public function getAccessibleColumn(){
        return [
            'ref'=>'Ref',
            'method'=>'Method',
            'contact_info'=>'Contact Info',
            'phone_number'=>'Phone Number',
            'token'=>'Token'
        ];
    }

    public function getFillableColumn(){
        return [
            // 'method'=>'Method',
            // 'contact_info'=>'Contact Info',
            // 'phone_number'=>'Phone Number'
        ];
    }
}
