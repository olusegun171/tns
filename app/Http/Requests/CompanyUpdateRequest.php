<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CompanyUpdateRequest extends FormRequest
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
            'id'    => 'required|integer|exists:contacts',
            'name'  => 'required',
            'year_founded' => 'nullable|integer',
            'street_address' => 'nullable|max:50',
            'city' => 'nullable|max:50',
            'state' => 'nullable|max:50',
            'zip_code' => 'nullable|integer',
            'country' => 'nullable',
        ];
    }

    public function messages()

    {

        return [
            'id.exists' => 'Company with the ID does not exist',
            'name.required' => 'name is required',
            'year_founded.integer' => 'Year found  must be integer',
            'street_address.max' => 'Street address must exceed 50 characters',
            'city.max' => 'City must exceed 50 characters',
            'state.max' => 'State must exceed 50 characters',
            'zip_code.integer' => 'Zip code must be integer',           
        ];

    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));

    }
}
