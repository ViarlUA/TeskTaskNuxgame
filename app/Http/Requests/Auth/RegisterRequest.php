<?php

namespace App\Http\Requests\Auth;

use App\Dto\Auth\RegisterDto;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string', 'max:255'],
        ];
    }
    
    public function getDto(): RegisterDto
    {
        return new RegisterDto(
            $this->validated('username'),
            $this->validated('phone')
        );
    }
}
