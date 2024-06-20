<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEntityType extends Model
{
    use HasFactory;

    protected $table = 'business_entity_types';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = ['name', 'description'];

}
