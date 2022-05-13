<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeoperationRequest extends FormRequest
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
            'title' => ["required","min:5","max:50"],
            'action' => ["required", "in:in,out"],
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
            'title.required' =>__('Required Title'),
            'title.min' => __('Min 5 caracters'),
            'title.max' => __('Max 50 caracters'),

            'action.required' => __('Required action'),
            'action.in:in,out' => __('Must between Entrée et Sortie'),
        ];
    }    

}
