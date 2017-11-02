<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountsRequest extends FormRequest
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
            'bank' => 'required',
            'agency' => 'required',
            'number' => 'required'
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'bank.required' => 'Banco é requerido mas não foi informado',
            'agency.required' => 'Agência é requerido mas não foi informado',
            'number.required' => 'Conta é requerido mas não foi informado'
        ];
    }
}
