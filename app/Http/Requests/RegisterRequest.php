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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên!',
            'email.required' => 'Vui lòng nhập địa chỉ email!',
            'email.email' => 'Định dạng email không hợp lệ!',
            'email.unique' => 'Email này đã được đăng ký trên hệ thống!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp!',
        ];
    }
}