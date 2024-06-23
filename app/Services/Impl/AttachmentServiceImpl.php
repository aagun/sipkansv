<?php

namespace App\Services\Impl;

use App\Services\AttachmentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attachment;

class AttachmentServiceImpl implements AttachmentService
{
    public function save(array $attachment): Builder | Model
    {
        return Attachment::query()->create($attachment);
    }

    public function findOne(int $id): Builder | Model | null
    {
        return Attachment::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Builder | Model | null
    {
        return Attachment::query()->where('name', $name)->first();
    }

}
