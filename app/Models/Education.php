<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';
    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name', 'description'];
}
