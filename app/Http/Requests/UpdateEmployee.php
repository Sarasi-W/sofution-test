<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployee extends StoreEmployee
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
        $rules = parent::rules();

        $rules['email'] = 'required|email|unique:employees,email,'.$this->route('employee')->id;
        $rules['phone'] = 'required|numeric|digits:10|unique:employees,phone,'.$this->route('employee')->id;

        return $rules;
    }
}