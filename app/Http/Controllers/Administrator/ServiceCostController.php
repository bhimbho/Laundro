<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCostRequest;
use App\Http\Service\ServiceCostService;
use App\Models\Service;
use App\Models\ServiceCost;
use Illuminate\Http\Request;

class ServiceCostController extends Controller
{

    protected ServiceCostService $serviceCostService;

    public function __construct(ServiceCostService $serviceCostService)
    {
        $this->serviceCostService = $serviceCostService;
    }

    public function index(Service $service) {
        return ServiceCost::with('service')->where('service_id', $service->id)->latest()->paginate(10);
    }

    public function get_service_cost($service, $attire) {
        try {
            $cost = $this->serviceCostService->getCost($service, $attire);
            return $this->makeJsonResponse([
                'data' => $cost
            ],201);
        } catch (\Throwable $th) {
           return $this->makeCustomErrorResponse('A cost is not associated with this attire and service. Contact Administrator to fill in a cost');
        }
    }

    public function store(ServiceCostRequest $request) {
        $validated = $request->validated();
        $serviceCostExist = ServiceCost::where([['attire_type_id', $validated['attire_type_id'], ['service_id', $validated['service_id']]]])->count() > 0;
        if($serviceCostExist) {
            return $this->makeCustomErrorResponse([
                'error' => 'similar record already exist, a delete is advisable if record is considered redundant'
            ]);
        }
        ServiceCost::create($validated);
        return $this->makeSuccessResponse();
    }

    // public function update(ServiceCostRequest $request, ServiceCost $serviceCost) {
    //     if ($delivery_method->loadCount('transactions')->transactions_count > 0) {
    //         return $this->makeCustomErrorResponse(
    //             'This cannot be Updated. Try Deleting and Recreating with desired title or cost');
    //     }
    //     $validated = $request->validated();
    //     $delivery_method->cost = $validated['cost'];
    //     $delivery_method->name = $validated['name'];
    //     $delivery_method->name = $validated['times'];
    //     $delivery_method->update();
    //     return $this->makeUpdatedResponse();
    // }

    public function delete(ServiceCost $serviceCost) {
        $serviceCost->delete();
        $this->makeDeletedResponse();
    }
}
