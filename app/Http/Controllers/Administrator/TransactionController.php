<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        $perBookingTotal = 0;
        $transactions = Transaction::with('bookings.attireType', 'bookings.service', 'bookings.service_method', 'delivery_method', 'administrator', 'customer')->paginate(20);
        foreach ($transactions->items() as $bookings) {
            foreach ($bookings->bookings as $booking) {
                $booking->service->load([
                    'service_cost' => function ($query) use ($booking) {
                        $query->where('attire_type_id', $booking->attireType->id);
                    },
                ]);
            }
            // $total += $perBookingTotal + $bookings->delivery_method->cost;
            // $bookings->total = $total;
        }

        foreach ($transactions->items() as $bookings) {
            foreach ($bookings->bookings as $booking) {
                $perBookingTotal = $booking->perBookingTotal = (($booking->service->service_cost->cost + ($booking->service_method !== null ? $booking->service_method->cost : 0)) * $booking->quantity);
            }
            $total += $perBookingTotal + $bookings->delivery_method->cost;
            $bookings->total = $total;
        }
        

        return $this->makeJsonResponse([
            'data' =>  $transactions
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($transactionID)
    {
        $transaction = Transaction::with('bookings.attireType', 'bookings.service', 'booking.service_method', 'delivery_method', 'administrator', 'customer')->where('transactions.id', $transactionID)->get();
        foreach ($transaction as $bookings) {
            foreach ($bookings->bookings as $booking) {
                $booking->service->load([
                    'service_cost' => function ($query) use ($booking) {
                        $query->where('attire_type_id', $booking->attireType->id);
                    },
                ]);
            }
        }

        return $this->makeJsonResponse([
            'data' => $transaction
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
