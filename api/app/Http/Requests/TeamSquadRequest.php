<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TeamSquadRequest extends FormRequest
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
            'squadName' => 'required|max:255',
            'description' => 'required|max:500',
            'achievement' => 'required|max:500'
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
