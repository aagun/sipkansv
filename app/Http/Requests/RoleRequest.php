<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Role;

class RoleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:4',
                'max:15',
                'starts_with:RO_,ro_,rO_,Ro_',
                Rule::unique(Role::class, 'name')
            ],
            'description' => [
                'required',
                'string'
            ]
        ];
    }
}
