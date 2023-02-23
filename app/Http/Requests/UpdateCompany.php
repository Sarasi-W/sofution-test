<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Requests\StoreCompany;
use Illuminate\Support\Arr;

class UpdateCompany extends StoreCompany
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

        $rules['email'] = 'required|email|unique:companies,email,'.$this->route('company')->id;
        $rules['logo'] = 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100';
        $rules['website'] = 'required|url|unique:companies,website,'.$this->route('company')->id;

        return $rules;
    }
}