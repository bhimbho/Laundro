<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, UUID;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = ['firstname'];
}
