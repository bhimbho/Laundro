<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceMethodStoreRequest;
use App\Http\Service\ServiceMethodService;
use App\Models\Service;
use App\Models\ServiceMethod;
use App\Traits\QuickResponseTrait;

class ServiceMethodController extends Controller
{

    protected ServiceMethodService $serviceMethod;

    public function __construct(ServiceMethodService $serviceMethod)
    {
        $this->serviceMethod = $serviceMethod;
    }

    public function get_service_method_cost($hours, $group, $serviceId) {
        $serviceMethod = $this->serviceMethod->getServiceMethodCost($hours, $group, $serviceId);
        return $this->makeJsonResponse([
            'data' => $serviceMethod
        ], 200);
    }

    public function store(ServiceMethodStoreRequest $request) {
        $validated = $request->validated();
        if($this->serviceMethod->hasExisting($validated)) {
            return $this->makeCustomErrorResponse([
                'error' => 'similar record already exist, a delete is advisable if record is considered redundant'
            ]);
        }
        $this->serviceMethod->storeServiceMethod($validated);
        return $this->makeSuccessResponse();
    }

    public function index(Service $service) {
        return ServiceMethod::with('services')->where('service_id', $service->id)->latest()->paginate(10);
    }

    public function deleted(Service $service) {
        return ServiceMethod::with('services')->where('service_id', $service->id)->onlyTrashed()->latest()->paginate(10);
    }

    public function delete(ServiceMethod $serviceMethod) {
        $serviceMethod->delete();
        return $this->makeDeletedResponse();
    }
}
