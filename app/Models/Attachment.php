<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['name', 'link'];

    public function activityReport(): HasOne
    {
        return $this->hasOne(ActivityReport::class, 'attachment_id', 'id');
    }

}
