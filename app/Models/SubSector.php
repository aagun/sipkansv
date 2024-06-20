<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubSector extends Model
{
    use HasFactory;

    protected $table = 'sub_sectors';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = ['name', 'description'];

    public function kblis(): HasMany
    {
        return $this->hasMany('kblis', 'sub_sector_id', 'id');
    }
}
