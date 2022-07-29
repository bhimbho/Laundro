<?php
namespace App\Http\Service;

use App\Models\Service;
use App\Models\ServiceCost;

class ServiceService {
    public function store($validated) {
        Service::create([
            'title' => $validated['title'],
            'authorised_by' => request()->user()->id
        ]);
    }
}