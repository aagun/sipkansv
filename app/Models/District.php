<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = false;
    protected $fillable = ['id', 'name', 'province_id'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function listSubDistrict(): HasMany
    {
        return $this->hasMany(SubDistrict::class, 'district_id', 'id');
    }
}
