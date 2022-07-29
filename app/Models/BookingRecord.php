<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRecord extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Get the user associated with the BookingRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attireType()
    {
        return $this->belongsTo(AttireType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
