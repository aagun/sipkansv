<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    use HasFactory;
    protected $table = 'institutions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable= ['name', 'description'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'institution_id', 'id');
    }
}
