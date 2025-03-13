<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'bail|required|string|min:2|max:50',
            'last_name' => 'bail|required|string|min:2|max:50',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'birthdate' => 'required|date|before_or_equal:'. now()->subYears(18)->toDateString(),
        ];
    }



    public function messages(): array
    {
        return [
            // 'profile_image.image' => 'The file must be an image.',
            // 'profile_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            // 'profile_image.max' => 'The image may not be greater than 2MB.',
            // 'first_name.required' => 'The first name field is required.',
            // 'last_name.required' => 'The last name field is required.',
            // 'email.required' => 'The email field is required.',
            // 'email.email' => 'The email must be a valid email address.',
            // 'email.unique' => 'The email has already been taken.',
            // 'password.required' => 'The password field is required.',
            // 'password.min' => 'The password must be at least 8 characters.',
            // 'password.confirmed' => 'The password confirmation does not match.',
            // 'birthdate.required' => 'The birthdate field is required.',
            // 'birthdate.date' => 'The birthdate must be a valid date.',
            'birthdate.before_or_equal' => 'You must be at least 18 years old.',
        ];
    }

}
