<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAltStore extends FormRequest
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
            'name' => 'bail|Required|String|max:255', //bail -> para quan una de les validacions no compleix
            'email' => 'Required|unique:users|email',
            'password' => 'Required|confirmed|min:6',
            'password_confirmation' => 'Required|min:6'
        ];
    }
}
