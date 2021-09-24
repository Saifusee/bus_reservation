<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPickupPointRequest extends FormRequest
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
            'pickup_point_address' => 'bail|required|string|max:255',
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
            '*.required' => 'This field cannot be empty.',
            '*.max' => 'Input cannot exceed more than 255 characters.',
            '*.string' => 'Invalid Input',
        ];
    }
}
