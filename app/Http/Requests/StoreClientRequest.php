<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name'=>'string|required|max:255',
            'dni'=>'string|required|unique:products|max:8',
            'ruc'=>'string|required|unique:products|max:11',
            'address'=>'string||required|max:255',
            'phone'=>'string|required|unique:clients|max:9',
            'email'=>'string||required|unique:clients|max:255|email:rfc,dns',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Este campo es requerido',
            'name.string'=>'El valor no es correcto ',
            'name.max'=>'Solo se permite 250 caracteres',

            'dni.string'=>'El campo no es valido',
            'dni.required'=>'Este campo es reauerido',
            'dni.unique'=>'Ya se encuentra registrado',
            'dni.max'=>'Solo se permite 8 caracteres`?.,mnb` ',
            

            'ruc.string'=>'El valor no es correcto',
            'ruc.required'=>'Este campo es requerido',
            'ruc.unique'=>'Ya se encuntra registrado',
            'ruc.max'=>'Solo se permite 11 caracteres',
            
            'address.string'=>'El campo no es valido',
            'address.required'=>'Este campo es requerido',
            'address.max'=>'Solo se permite 255 caracteres',
            
            'phone.string'=>'El campo no es valido',
            'phone.required'=>'Este campo es requerido',
            'phone.unique'=>'Ya se encuentra registrado',
            'phone.max'=>'Solo se permite 9 caracteres',
            
            'email.string'=>'El campo no es valido',
            'email.required'=>'Este campo es requerido',
            'email.unique'=>'Ya se encuentra registrado',
            'email.max'=>'Solo se permite 255 caracteres',
            'email.email'=>'No es un correo',
            
        ];
    }
}
