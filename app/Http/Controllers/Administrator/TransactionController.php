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
       
        return $this->makeJsonResponse([
            'data' =>  Transaction::with('customer')->paginate(20)
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
        $transaction = Transaction::with('bookings.attireType', 'bookings.service', 'delivery_method', 'administrator', 'customer')->where('transactions.id', $transactionID)->get();
        foreach ($transaction as $bookings) {
            foreach ($bookings->bookings as $booking) {
                $booking->service->load([
                    'service_costs' => function ($query) use ($booking) {
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
