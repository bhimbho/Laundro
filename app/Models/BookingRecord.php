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

    protected $fillable = ['transaction_id', 'attire_type_id', 'service_id', 'quantity', 'status', 'service_method_id', 'expected_collection_date'];

    protected $casts = [
        'expected_collection_date' => 'datetime:D d-M-Y'
    ];

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

    public function service_method() {
        return $this->belongsTo(ServiceMethod::class, 'service_method_id');
    }
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }


}
