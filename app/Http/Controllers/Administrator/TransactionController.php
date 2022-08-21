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
        $transactions = Transaction::withTrashed('bookings.attireType', 'bookings.service', 'bookings.service_method', 'delivery_method', 'administrator', 'customer')->paginate(20);
        foreach ($transactions->items() as $bookings) {
            $bookings->has_special = false;
            $bookings->total_quantity = 0;
            foreach ($bookings->bookings as $booking) {
                $booking->service->load([
                    'service_cost' => function ($query) use ($booking) {
                        $query->where([['attire_type_id', $booking->attireType->id], ['service_id', $booking->service_id]])->withTrashed();
                    },
                ]);
                if ($booking->service_method !== null) {
                    $bookings->has_special = true;
                }
                $bookings->total_quantity += $booking->quantity;
            }
        }

        foreach ($transactions->items() as $bookings) {
            $total = 0;
            foreach ($bookings->bookings as $booking) {
                $booking->perBookingTotal = ($booking->service->service_cost->cost * $booking->quantity) + 
                    ($booking->service_method !== null ? ($booking->service_method->cost * $booking->quantity) : 0);
                $total += $booking->perBookingTotal;
            }
            $bookings->total = $total + $bookings->delivery_method->cost;
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
        $transaction = Transaction::with('bookings.attireType', 'bookings.service', 'bookings.service_method', 'delivery_method', 'administrator', 'customer')->where('transactions.id', $transactionID)->get();
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
