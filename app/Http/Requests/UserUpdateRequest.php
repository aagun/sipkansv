<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Enums\Gender;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserUpdateRequest extends BaseRequest
{

    protected function passedValidation(): void
    {
        $this->merge([
            'role_id' => $this->role,
            'department_id' => $this->department,
            'education_id' => $this->education,
            'grade_level_id' => $this->grade_level,
            'institution_id' => $this->institution,
            'rank_id' => $this->rank,
            'position_id' => $this->position,
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
        ]);
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
            'role' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('roles', 'id')
            ],
            'position' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('positions', 'id')
            ],
            'rank' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('ranks', 'id')
            ],
            'grade_level' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('grade_levels', 'id')
            ],
            'education' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('educations', 'id')
            ],
            'department' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('departments', 'id')
            ],
            'institution' => [
                'sometimes',
                'nullable',
                'numeric',
                Rule::exists('institutions', 'id')
            ],
        ];
    }
}
