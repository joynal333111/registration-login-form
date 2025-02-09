<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                => 'required|string|max:255',
            'email'               => 'required|string|email|max:255|unique:users',
            'password'            => 'required|string|min:6|confirmed',
            'verification_method' => 'required|in:otp,link',
         ];
    }

    public function messages(): array
    {
        return [
            'name.required'                => 'Name is required.',
            'name.string'                  => 'Name must be a valid text.',
            'name.max'                     => 'Name cannot exceed 255 characters.',

            'email.required'               => 'Email is required.',
            'email.string'                 => 'Email must be a valid text format.',
            'email.email'                  => 'Please enter a valid email address.',
            'email.max'                    => 'Email cannot exceed 255 characters.',
            'email.unique'                 => 'This email is already registered. Please log in instead.',

            'password.required'            => 'Password is required.',
            'password.string'              => 'Password must be a valid string.',
            'password.min'                 => 'Password must be at least 6 characters long.',
            'password.confirmed'           => 'Password confirmation does not match.',

            'verification_method.required' => 'Please select a verification method.',
            'verification_method.in'       => 'Invalid verification method selected. Choose either OTP or Verification Link.',
         ];
    }
}
