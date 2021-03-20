<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'name' => ['nullable', 'string','min:5','max:23'],
            'nickname' => ['nullable', 'string', 'min:5', 'max:50', 'unique:users', 'alpha_dash'],
            'about' => ['nullable', 'string','max:150'],
            'site' => ['nullable', 'string','max:50'],
            'avatar' => ['nullable', 'mimes:jpeg,png', 'max:5000'],
            'banner' => ['nullable', 'mimes:jpeg,png', 'max:5000', 'dimensions:max_height=100'],
        ];
    }
}
