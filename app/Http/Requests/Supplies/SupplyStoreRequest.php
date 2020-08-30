<?php

namespace App\Http\Requests\Supplies;

use Illuminate\Foundation\Http\FormRequest;

class SupplyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => ['required'],
            'admission_price' => ['required'],
            'quantity' => ['required'],
            'status' => ['required'],
            'supply_date' => ['required'],
        ];
    }
}
