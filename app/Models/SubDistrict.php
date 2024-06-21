<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubDistrict extends Model
{
    use HasFactory;

    protected $table = 'sub_districts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = false;
    protected $fillable = ['id', 'name', 'district_id'];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
