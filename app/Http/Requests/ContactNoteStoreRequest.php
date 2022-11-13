<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContactNoteStoreRequest extends FormRequest
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

            'contact_id'  => 'required|integer|exists:contacts,id',
            'note' => 'required',

        ];
    }

    public function messages()

    {

        return [

            'contact_id.required' => 'Contact ID is required',
            'contact_id.integer' => 'Contact ID must be integer',
            'contact_id.exists' => 'Contact ID does not exist',
            'note.required' => 'Note is required',
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
