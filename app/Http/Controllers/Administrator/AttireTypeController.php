<?php

namespace App\Http\Controllers\Administrator;

use App\Models\AttireType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttireRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\QuickResponseTrait;

class AttireTypeController extends Controller
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
            'data' => AttireType::all()
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
        $attireImage = Storage::put('attires', $validated['attire_image']);
        AttireType::create([
            'title' => $validated()['title'],
            'attire_image' => $attireImage
        ]);

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
    public function update(Request $request, AttireType $attire)
    {
        //
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
