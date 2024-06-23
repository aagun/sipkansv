<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface AttachmentService
{
    public function save(array $attachment): Builder | Model;

    public function findOne(int $id): Builder | Model | null;

    public function findByName(string $name): Builder | Model | null;

}
