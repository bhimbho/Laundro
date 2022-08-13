<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Models\BookingRecord;
use Illuminate\Http\Request;
use App\Http\Service\BookingRecordService;

class BookingRecordController extends Controller
{

    private BookingRecordService $bookingRecordService;

    public function __construct(BookingRecordService $bookingRecordService)
    {
        $this->bookingRecordService = $bookingRecordService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $validated = $request->validated();
        // try {
            $this->bookingRecordService->process_booking($validated);
        // } catch (\Throwable $th) {
        //     return $this->makeFailedResponse('Record Cannot be created');
        // }
        return $this->makeSuccessResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookingRecord  $bookingRecord
     * @return \Illuminate\Http\Response
     */
    public function show(BookingRecord $bookingRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookingRecord  $bookingRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingRecord $bookingRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookingRecord  $bookingRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingRecord $bookingRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookingRecord  $bookingRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingRecord $bookingRecord)
    {
        return $bookingRecord->forceDelete();
    }
}
