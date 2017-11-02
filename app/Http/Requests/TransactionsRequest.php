<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
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
            'type' => 'required',
            'status' => 'required',
            'operation' => 'required',
            'value' => 'required',
            'prevision_date' => 'required',
            'realization_date' => 'required'
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
            'type.required' => 'Tipo é requerido mas não foi informado',
            'status.required' => 'Status é requerido mas não foi informado',
            'operation.required' => 'Operação é requerido mas não foi informado',
            'value.required' => 'Valor mas não foi informado',
            'prevision_date.required' => 'Data prevista é requerido mas não foi informado',
            'realization_date.required' => 'Data realizada é requerido mas não foi informado',
        ];
    }
}
