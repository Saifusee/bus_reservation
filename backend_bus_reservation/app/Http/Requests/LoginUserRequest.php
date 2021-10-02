<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'bail|required|string|max:255|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
            'password' => 'bail|required|string|min:8|max:32|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[\W]).{8,32}$/i',
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'E-Mail field cannot be empty.',
            'email.max' => 'E-Mail cannot exceed 255 characters.',
            'email.regex' => 'Invalid E-Mail format must follow example@gmail.com.',
            'password.required' => 'Password field cannot be empty.',
            'password.min' => 'Password must be more than 8 characters.',
            'password.max' => 'Password cannot exceed more than 32 characters.',
            'password.regex' => 'Password must contain an Uppercase, Lowercase, Number and Special Symbols',
        ];
    }
}
