<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCost extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['cost', 'service_id', 'attire_type_id'];

    /**
     * Get the user that owns the ServiceCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attire_types()
    {
        return $this->belongsTo(AttireType::class);
    }

    /**
     * Get the user associated with the ServiceCost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
