<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addEventRequest extends FormRequest
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
            'title' => 'required|max:30',
            'info' => 'required|max:1000',
            'cover' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'city' => 'required|max:50',
            'address' => 'max:50',
            'tickets' => 'max:100',
            'vk' => 'max:100',
            'fb' => 'max:100',
            'time' => 'max:5',
            'eventdata' => 'required',

            'youbrand' => 'max:100',
            'concert' => 'max:100',
            'yandex' => 'max:100',
            'kassir' => 'max:100',
            'ponominalu' => 'max:100',
            'ticketland' => 'max:100',
            'radario' => 'max:100'
        ];
    }
}
