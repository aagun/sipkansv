<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PageableRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->order)) {
            $this->merge(['order' => strtolower($this->order)]);
        }
    }

    protected function passedValidation(): void
    {
        if (!isset($this->limit)) {
            $this->merge(['limit' => 10]);
        }

        if (!isset($this->offset)) {
            $this->merge(['offset' => 1]);
        }

        if (!isset($this->order)) {
            $this->merge(['order' => 'asc']);
        }

        if (!isset($this->sort)) {
            $this->merge(['sort' => null]);
        }

        if (!isset($this->search)) {
            $this->merge(['search' => null]);
        }
    }

    public function rules(): array
    {
        return [
            'offset' => ['sometimes', 'numeric'],
            'limit' => ['sometimes', 'numeric'],
            'order' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
            'sort' => ['sometimes', 'string'],
            'search' => ['sometimes', 'array']
        ];
    }
}
