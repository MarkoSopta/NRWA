<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\manager;
use App\Http\Requests\StoremanagerRequest;
use App\Http\Requests\UpdatemanagerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ManagerResource;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return manager::all();
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(manager $manager)
    {
        return new ManagerResource($manager);    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemanagerRequest $request, manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(manager $manager)
    {
        //
    }
}
