<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kbli extends Model
{
    use HasFactory;

    protected $table = 'kblis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = ['code', 'name', 'sub_sector_id'];

    public function sub_sectors(): BelongsTo
    {
        return $this->belongsTo(SubSector::class, 'sub_sector_id', 'id');
    }
}
