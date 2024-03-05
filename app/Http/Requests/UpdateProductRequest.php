<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=>'string|required|unique:products,name,'.$this->route('product')->id.'|max:255',
            'image'=>'required|dimensions:min_width=100,min_height=200',
            'sell_price'=>'required',
            'category_id'=>'integer|required|exists:App\Category,id',
            'provider_id'=>'integer|required|exists:App\Provider,id',
        ];
    }
    public function messages()
    {
        return[
            'name.string'=>'Campo no valido',
            'name.required'=>'El campo es obligatorio',
            'name.unique'=>'Ya se encuentra registrado',
            'name.max'=>'Solo se permite 255 caracteres',


            'image.required'=>'',
            'image.dimensions'=>'',

            'sell_price.required'=>'El campo es obligatorio',

            'category_id.integer'=>'El valor tiene que ser entero',
            'category_id.required'=>'El campo es requerido',
            'category_id.exists'=>'La categoria no existe',

            'provider_id.integer'=>'El valor tiene que ser entero',
            'provider_id.required'=>'El campo es requerido',
            'provider_id.exists'=>'La proveedor no existe',
        ];
    }
}
