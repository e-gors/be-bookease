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
            'firstName' => ['required'],
            'lastName' => ['required'],
            'userName' => ['nullable'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:22'],
            'role' => ['required', Rule::in(['Admin', 'Customer', 'Service Provider'])],
            'userType' => ['required', Rule::in(['I', 'B', 'i', 'b'])], // I | i = Individual, B | b = Business
            'status' => ['required', Rule::in(['active', 'inactive', ' banned', 'deleted'])],
            'bannedUntil' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'user_name' => $this->userName,
            'user_type' => $this->userType,
            'banned_until' => $this->bannedUntil
        ]);
    }
}
