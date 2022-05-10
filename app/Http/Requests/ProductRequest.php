<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'Title' => ['required','max:255'],
            'Description' => ['required', 'max:1000'],
            'Price' => ['required','min:1'],
            'Stock'=>['required', 'min:0'],
            'Status'=>['required','in:available,unavailable'],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function($validator){
            if($this->Status == 'available' && $this->Stock == 0 )
            {
                $validator->errors()->add('Stock', 'If available must have stock');
            }
        });
    }
}
