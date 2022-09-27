<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Changepass extends FormRequest
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
            'lpass' => ['required', 'string', 'max:255'],
            'newpass' => ['required', 'string', 'min:8']
        ];
    }

    public function attributes()
    {
        return [
            'lpass' => 'last password',
            'newpass' => 'new password'
        ];
    }
}
