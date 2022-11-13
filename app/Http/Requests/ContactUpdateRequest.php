<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContactUpdateRequest extends FormRequest
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
