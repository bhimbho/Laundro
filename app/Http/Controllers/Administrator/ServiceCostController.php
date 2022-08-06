<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCostRequest;
use App\Http\Service\ServiceCostService;
use App\Models\AttireType;
use App\Models\Service;
use App\Traits\QuickResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceCostController extends Controller
{
    use QuickResponseTrait;

    protected ServiceCostService $serviceCostService;

    public function __construct(ServiceCostService $serviceCostService)
    {
        $this->serviceCostService = $serviceCostService;
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
}
