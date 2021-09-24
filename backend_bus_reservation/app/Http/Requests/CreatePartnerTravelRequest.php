<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreatePartnerTravelRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $partner_travel_id = null;
        if (isset($request->id)) {
            $partner_travel_id = $request->id;
        }
        return [
            'address' => 'bail|required|string|max:255',
            'description' => 'bail|string|max:1000',
            'contact_1' => 'bail|required|string|max:255',
            'contact_2' => 'bail|required|string|max:255',

            //Now we checking that is email and travel name unique in each user Partner Travels list
            //unique validation use key value as column field name in this case.
            'email_1' => [
                'bail',
                'required',
                'string',
                'max:255',
                'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
                Rule::unique('partner_travels')->where(function ($query) {
                    return $query->where('user_id', 1);
                })->ignore($partner_travel_id)
            ],
            'email_2' => [
                'bail',
                'string',
                'max:255',
                'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
                Rule::unique('partner_travels')->where(function ($query) {
                    return $query->where('user_id', 1);
                })->ignore($partner_travel_id)
            ],
            'partner_travel_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('partner_travels')->where(function ($query) {
                    return $query->where('user_id', 1);
                })->ignore($partner_travel_id)
            ]
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
            'partner_travel_name.unique' => 'There\'s already a Travel Agency with this name.',
            'email_1.unique' => 'E-Mail already registered with different account.',
            'email_2.unique' => 'E-Mail already registered with different account.',
            '*.required' => 'This field cannot be empty.',
            'description.max' => 'Description cannot exceed more than 255 characters.',
            '*.max' => 'Input cannot exceed more than 255 characters.',
            '*.regex' => 'E-mail format invalid, must follow example@mail.com',
            '*.string' => 'Invalid Input',

        ];
    }
}
