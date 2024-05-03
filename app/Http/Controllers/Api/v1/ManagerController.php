<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\manager;
use App\Http\Requests\v1\ManagerStoreRequest;
use App\Http\Requests\v1\ManagerUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ManagerResource;
use App\Http\Resources\v1\ManagerCollection;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ManagerCollection(manager::paginate());
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagerStoreRequest $request)
    {
        return new ManagerResource(manager::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(manager $manager)
    {
        return new ManagerResource($manager);    
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerUpdateRequest $request, manager $manager)
    {
        
        $manager->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manager = manager::find($id);

        if ($manager) {
          $manager->delete();
          return response()->json(['message' => 'Manager deleted successfully'], 200);
        } else {
          return response()->json(['error' => 'Manager not found'], 404);
        }
          }
    
}
