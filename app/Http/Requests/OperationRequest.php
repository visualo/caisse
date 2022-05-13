<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date_operation' => ["required","date"],
            'total_operation' => ["required", "numeric"],
            'comment' => ["nullable", "string", "max:1000"],
            'type_opeartion' => ['required',"integer"],
            'caisse' => ['required',"integer"],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date_operation.required' =>__('Required Date'),
            'date_operation.date' => __('Date note valid'),
            'total_operation.required' => __('Required encaissement'),
            'total_operation.numeric' => __('Must a double'),

            'comment.max:1000' => __('Not Max 1000'),

            'type_opeartion.required' => __('Required type operation'),
            'type_opeartion.integer' => __('Type operation incorrect'),
            'caisse.required' => __('Required caisse'),
            'caisse.integer' => __('Caisse incorrect'),
        ];
    }    

}
