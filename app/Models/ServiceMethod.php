<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceMethod extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $primary_key = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['hours', 'cost', 'group', 'service_id'];

    /**
     * Get the user that owns the ServiceMethod
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function services()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
