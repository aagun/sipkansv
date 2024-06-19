<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Enums\Gender;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCreateRequest extends BaseRequest
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
            'name' => [
                'required',
                'string'
            ],
            'gender' => [
                'required',
                Rule::enum(Gender::class)
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:32',
                Rule::unique('users', 'username')
            ],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->mixedCase()
                    ->numbers()
            ],
            'nip' => [
                'nullable',
                'string',
                'min:16',
                'max:18',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:16'
            ],
            'email' => [
                'nullable',
                'string',
                'email'
            ],
            'role' => [
                'nullable',
                'numeric',
                Rule::exists('roles', 'id')
            ],
            'position' => [
                'nullable',
                'numeric',
                Rule::exists('positions', 'id')
            ],
            'rank' => [
                'nullable',
                'numeric',
                Rule::exists('ranks', 'id')
            ],
            'grade_level' => [
                'nullable',
                'numeric',
                Rule::exists('grade_levels', 'id')
            ],
            'education' => [
                'nullable',
                'numeric',
                Rule::exists('educations', 'id')
            ],
            'department' => [
                'nullable',
                'numeric',
                Rule::exists('departments', 'id')
            ],
            'institution' => [
                'nullable',
                'numeric',
                Rule::exists('institutions', 'id')
            ],
        ];
    }
}
