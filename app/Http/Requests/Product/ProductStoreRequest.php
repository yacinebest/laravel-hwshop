<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['required'],
            'parent_id' => ['required'],
            'price' => ['required'],
            'admission_price' => ['required'],
            'copy_number' => ['required'],
            'supply_date' => ['required'],
            'started_at' => ['required'],
            'brands' => ['required'],
        ];
    }
}
