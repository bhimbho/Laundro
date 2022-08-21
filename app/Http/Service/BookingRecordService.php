<?php
namespace App\Http\Service;

use App\Http\Enum\StatusEnum;
use App\Models\BookingRecord;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingRecordService
{
    private ServiceMethodService $serviceMethodService;
    private AttireTypeService $attireTypeService;

    public function __construct(ServiceMethodService $serviceMethodService, AttireTypeService $attireTypeService)
    {
        $this->serviceMethodService = $serviceMethodService;
        $this->attireTypeService = $attireTypeService;
    }

    public function process_booking($validated)
    {
        DB::transaction(function () use ($validated) {
            $transanction = $this->storeTransaction($validated);

            foreach ($validated['bookings'] as $booking) {
                $this->store($booking, $transanction);
            }
        }) ;
    }

    public function store($booking, $transaction)
    {
        $serviceMethod = $this->serviceMethodService->getServiceMethod(
            $booking['service_method_id'], 
        );
        BookingRecord::create([
            'transaction_id' => $transaction->id,
            'status' => StatusEnum::TAGGING,
            'attire_type_id' => $booking['attire_type_id'],
            'service_id' =>  $booking['service_id'],
            'quantity' => $booking['quantity'],
            'service_method_id' => ($serviceMethod) ? $serviceMethod->id : null,
            'service_cost_id' => $booking['service_cost_id'],
            'expected_collection_date' => ($serviceMethod) ? Carbon::now()->addHours($serviceMethod->hours) :
            Carbon::now()->addHours(48),
        ]);
    }

    public function storeTransaction($validated)
    {
        return Transaction::create([
            'customer_id' => isset($validated['customer_id']) ? $validated['customer_id'] : null,
            'customer_name' => isset($validated['customer_name']) ? $validated['customer_name'] : null,
            'customer_phone' => isset($validated['customer_phone']) ? $validated['customer_phone'] : null,
            'customer_email' => isset($validated['customer_email']) ? $validated['customer_email'] : null,
            'tag_no' => date('Hidmy'),
            'payment_type' => $validated['payment_type'],
            'authorised_by' => request()->user()->id,
            'delivery_method_id' =>$validated['delivery_method_id'],
        ]);
    }
}
