<?php

namespace App\Http\Controllers\Administrator;

use App\Models\AttireType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttireRequest;
use App\Http\Resources\AttireTypeResource;
use App\Http\Service\AttireTypeService;

class AttireTypeController extends Controller
{

    public function __construct(private AttireTypeService $attireTypeService)
    {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->makeJsonResponse([
            'data' =>  AttireTypeResource::collection(AttireType::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttireRequest $request)
    {
        $validated = $request->validated();
        $this->attireTypeService->store($validated);

        return $this->makeSuccessResponse();
    }

    /**
     * Display the specified attire.
     *
     * @param  \App\Models\AttireType  $attireType
     * @return \Illuminate\Http\Response
     */
    public function show(AttireType $attire)
    {
        return $this->makeJsonResponse([
            'data' => $attire
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttireType  $attireType
     * @return \Illuminate\Http\Response
     */
    public function update(AttireRequest $request, AttireType $attire)
    {
        $validated = $request->validated();
        $this->attireTypeService->update($validated, $attire);       
        return $this->makeUpdatedResponse(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttireType  $attireType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttireType $attire)
    {
        $attire->delete();
        $this->makeDeletedResponse();
    }
}
