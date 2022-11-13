<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContactStoreRequest extends FormRequest
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

            'company_id'  => 'required|integer|exists:companies,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required'

        ];
    }

    public function messages()

    {

        return [

            'company_id.required' => 'Company ID is required',
            'company_id.integer' => 'Company ID must be integer',
            'company_id.exists' => 'Company ID does not exist',
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'position.required' => 'Contact position is required',
            'email.required' => 'Contact email is required',
            'email.email' => 'Contact email is invalid',
            'mobile_no.required' => 'Contact mobile numer is required'
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
