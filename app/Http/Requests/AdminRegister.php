<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class AdminRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['required', new PasswordRule],
            'repassword' =>'same:password',
            'roles'=>'required|min:1'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'Name is required',
            'email.required'=>'Email is required',
            'password.required'=>'Password is required'
        ];
    }
}
