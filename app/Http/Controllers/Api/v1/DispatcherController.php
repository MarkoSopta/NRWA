<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\dispatcher;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DispatcherResource;
use App\Http\Resources\v1\DispatcherCollection;
use App\Http\Requests\v1\DispatcherStoreRequest;
use App\Http\Requests\v1\DispatcherUpdateRequest;

class DispatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new DispatcherCollection(dispatcher::paginate());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(DispatcherStoreRequest $request)
    {
        return new DispatcherResource(dispatcher::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(dispatcher $dispatcher)
    {
        return new DispatcherResource($dispatcher);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DispatcherUpdateRequest $request, dispatcher $dispatcher)
    {
        $dispatcher->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dispatcher = dispatcher::find($id);

  if ($dispatcher) {
    $dispatcher->delete();
    return response()->json(['message' => 'Dispatcher deleted successfully'], 200);
  } else {
    return response()->json(['error' => 'Dispatcher not found'], 404);
  }
    }
}
