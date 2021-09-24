<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {

        return [
            'from_location' => 'bail|required|string|max:255',
            'to_location' => 'bail|required|string|max:255',
            'passenger_name' => 'bail|required|string|max:255',
            'passenger_contact_1' => 'bail|required|string|max:255',
            'passenger_contact_2' => 'bail|required|string|max:255',
            'passenger_email' => 'bail|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i|string|max:255',
            'sleeper_no' => 'bail|string|max:255',
            'seat_no' => 'bail|string|max:255',
            'bus_no' => 'bail|required|integer|max:4',
            'total_seats' => 'bail|required|integer|max:3',
            'amount' => 'bail|required|integer|max:5',
            'advance' => 'bail|required|integer|max:5',
            'reporting_time' => 'bail|required|before_or_equal:departure_time',
            'departure_time' => 'bail|required|after_or_equal:reporting_time',
            'booking_date' => 'bail|required|before_or_equal:departure_date',
            'departure_date' => 'bail|required|after_or_equal:booking_date',
            'pickup_point_id' => 'bail|required',
            'partner_travel_id' => 'bail|required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'This field cannot be empty.',
            '*.string' => 'Invalid Input',
            '*.regex' => 'E-mail format invalid, must follow example@mail.com',
            '*.integer' => 'Invalid input, must be integer value',
            'bus_no.max' => 'Bus number must be 4 digit value.',
            'total_seats_no.max' => 'Cannot exceed more than 3 digit.',
            'amount.max' => 'Cannot exceed more than 5 digit.',
            'advance.max' => 'Cannot exceed more than 5 digit.',
            '*.max' => 'Input cannot exceed more than 255 characters.',
            'departure_date.after_or_equal' => 'Date must be equal to today or after.',
            'departure_time.after_or_equal' => 'Time must be equal to or after reporting time.',
            'reporting_time.before_or_equal' => 'Time must be equal to or before departure time.'
        ];
    }
}
