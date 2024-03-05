<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
            'name'=>'required|string|max:255,',
            'email'=>'required|email|string|max:200|unique:providers,email,'. $this->route('provider')->id.'|max:255',
            'ruc_number'=>'required|string|max:11|min:11|unique:providers,ruc_number,'. $this->route('provider')->id.'|max:11',
            'address'=>'nullable|string|max:250',
            'phone'=>'required|string|max:9|min:9|unique:providers,phone,'. $this->route('provider')->id.'|max:9',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Este campo es requerido',
            'name.string'=>'El valor no es correcto ',
            'name.max'=>'Solo se permite 250 caracteres',

            'email.required'=>'Este campo es requerido',
            'email.email'=>'No es un correo electronico',
            'email.string'=>'El valor no es correcto',
            'email.max'=>'Solo permiten 200 caracteres',
            'email.unique'=>'Ya se encuentra registrado',

            'ruc_number.required'=>'Este campo es requerido',
            'ruc_number.string'=>'El valor no es correcto',
            'ruc_number.max'=>'Solo se requiere 11 caracteres',
            'ruc_number.min'=>'Se requiere 11 caracteres',
            'ruc_number.unique'=>'Ya se encuentra registrado',

            'addres.max'=>'Solo se permiten 255 caracteres',
            'addres.string'=>'El valor no es correcto',
           
            'phone.required'=>'Este campo es requerido',
            'phone.string'=>'',
            'phone.max'=>'Solo se permiten 9 caracteres',
            'phone.min'=>'Se requiere 9 caracteres',
            'phone.unique'=>'Ya se encuentra registrado',
        
          
        ];
    }
}


