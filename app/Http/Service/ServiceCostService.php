<?php
namespace App\Http\Service;

use App\Models\AttireType;
use App\Models\Service;
use App\Models\ServiceCost;

class ServiceCostService {

    /**
     * Fetch corresponding cost for a service and an attire type
     *
     * @param Request $validated
     * @return collection
     * @throws Exception
     */
    public function getCost($service, $attire) {
        return ServiceCost::where([['service_id', $service],['attire_type_id', $attire]])->firstOrFail()->cost;
    }
   
}