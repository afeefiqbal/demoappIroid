<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'image.required' => 'logo is required!',
            'first_name.required' => 'Email is required!',
            'phone.required' => 'Name is required!',
            'last_name.required' => 'logo is required!',
        ];
    }
}
