<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'int'],
            'unit_id' => ['required', 'int'],
//            'kit_id' => ['sometimes','exists:App\Models\Comment,id']
            'kit_id' => ['required', 'int'],
            'name' => ['required', 'string'],
            'dose' => ['required', 'decimal:1,3'],
            'comment' => ['required', 'string'],
            'status' => ['required', 'bool'],
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
