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
        return response()->json(new ManagerCollection(manager::paginate()));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagerStoreRequest $request)
    {
        return response()->json(new ManagerResource($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(manager $manager)
    {
      return response()->json(new ManagerResource($manager));   
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerUpdateRequest $request, manager $manager)
    {
        
      return response()->json(new ManagerResource(update($request->all())));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $manager = Manager::find($id);

      if ($manager) {
          $manager->delete();
          return response()->json(['message' => 'Manager deleted successfully'], 200);
      } else {
          return response()->json(['error' => 'Manager not found'], 404);
      }
  }
}
    

