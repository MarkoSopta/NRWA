<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\dispatcher;
use App\Http\Requests\StoredispatcherRequest;
use App\Http\Requests\UpdatedispatcherRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DispatcherResource;

class DispatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return dispatcher::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredispatcherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(dispatcher $dispatcher)
    {
        return new DispatcherResource($dispatcher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dispatcher $dispatcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedispatcherRequest $request, dispatcher $dispatcher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dispatcher $dispatcher)
    {
        //
    }
}