<?php
namespace App\Http\Service;

use App\Models\ServiceMethod;

class ServiceMethodService {

    public function getServiceMethodCost($hours, $serviceId, $group) {
        $service = $this->build_condition($hours, $group, $serviceId)->first();
        return $service ?: null;
    }

    public function storeServiceMethod($validated) {
        return ServiceMethod::create($validated);
    }

    public function hasExisting($validated) {
        return $this->build_condition($validated['hours'], $validated['group'], $validated['service_id'])->count() > 0;
    }

    private function build_condition($hours, $group, $serviceId) {
        return ServiceMethod::where([
            ['hours', $hours],
            ['service_id', $serviceId],
            ['group', $group],
        ]);
    }
}