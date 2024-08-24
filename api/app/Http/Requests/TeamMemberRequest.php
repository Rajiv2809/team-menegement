<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TeamMemberRequest extends FormRequest
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
            'squad_id' => 'required|max:255|exists:team_squads,id',
            'user_id' => 'required|max:500|exists:users,id'
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
