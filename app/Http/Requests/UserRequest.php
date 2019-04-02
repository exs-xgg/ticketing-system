<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidUsername;

class UserRequest extends FormRequest
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
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'suffix'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:1|max:255',
            'birthDate'    => 'nullable|max:255',
            // 'username'     => 'required|alpha_dash|unique:users|min:5|max:255',
            'username'     => ['required','unique:users','min:5','max:255', new ValidUsername],
            'email'        => 'required|string|email|unique:users|max:255',
            'mobileNumber' => 'nullable|alpha_num|digits:11|unique:users',
            'password'     => 'nullable|string|min:8|max:255',
        ];
    }
}
