<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\DeliveryMethodRequest;
use App\Models\DeliveryMethod;
use App\Traits\QuickResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
    use QuickResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->makeJsonResponse([
            'data' => DeliveryMethod::paginate()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryMethodRequest $request):JsonResponse
    {
        $validated = $request->validated();
        DeliveryMethod::create($validated);
        return $this->makeSuccessResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryMethod $delivery_method)
    {
        $delivery_method->loadCount('transactions');
        return $this->makeJsonResponse([
            'data' => $delivery_method
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryMethodRequest $request, DeliveryMethod $delivery_method)
    {
        if ($delivery_method->loadCount('transactions')->transactions_count > 0) {
            return $this->makeCustomErrorResponse(
                'This cannot be Updated. Try Deleting and Recreating with desired title or cost');
        }
        $validated = $request->validated();
        $delivery_method->cost = $validated['cost'];
        $delivery_method->name = $validated['name'];
        $delivery_method->name = $validated['times'];
        $delivery_method->update();
        return $this->makeUpdatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryMethod  $deliveryMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryMethod $delivery_method)
    {
        $delivery_method->delete();
        $this->makeDeletedResponse();
    }
}
