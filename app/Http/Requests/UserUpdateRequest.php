<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Enums\Gender;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequest extends BaseRequest
{
    protected function passedValidation(): void
    {
        $this->merge(['password' => Hash::make($this->password)]);
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists('users', 'id')
            ],
            'name' => [
                'sometimes',
                'required',
                'string'
            ],
            'gender' => [
                'sometimes',
                'required',
                Rule::enum(Gender::class)
            ],
            'username' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:32',
                Rule::unique('users', 'username')
            ],
            'password' => [
                'sometimes',
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->mixedCase()
                    ->numbers()
            ],
            'nip' => [
                'sometimes',
                'nullable',
                'string',
                'min:16',
                'max:18',
            ],
            'phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:16'
            ],
            'email' => [
                'sometimes',
                'nullable',
                'string',
                'email'
            ],
            'role_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('roles', 'id')
            ],
            'position_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('positions', 'id')
            ],
            'rank_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('ranks', 'id')
            ],
            'grade_level_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('grade_levels', 'id')
            ],
            'education_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('educations', 'id')
            ],
            'department_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('departments', 'id')
            ],
            'institution_id' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('institutions', 'id')
            ],
        ];
    }
}
