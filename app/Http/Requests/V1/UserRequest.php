<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is aWuthorized to make this request.
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:22'],
            'role' => ['nullable', Rule::in(['Admin', 'Customer', 'Service Provider'])],
            'userType' => ['nullable', Rule::in(['I', 'B', 'i', 'b'])], // I | i = Individual, B | b = Business
            'status' => ['required', Rule::in(['active', 'inactive', 'banned', 'deleted'])],
            'bannedUntil' => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_type' => $this->userType,
            'banned_until' => $this->bannedUntil,
            'status' => $this->status ?? 'active',
        ]);
    }
}
