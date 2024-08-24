<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTeamSquadRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'squadName' => 'nullable|max:255',
            'description' => 'nullable|max:500',
            'achievement' => 'nullable|max:500'
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'message' => 'invalid field',
                'error' => $validator->errors()
            ], 422)
        );
    }
}
