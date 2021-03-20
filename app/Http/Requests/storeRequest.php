<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'title' => 'max:100',
            'slug' => 'max:200',
            'message' => 'max:5000',
            'img' => 'mimes:jpeg,png,gif,jpg|max:5000',
            'videoPost' => 'max:100'
        ];
    }
}
