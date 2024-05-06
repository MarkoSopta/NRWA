<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $managers = manager::with('location')->get();
    foreach ($managers as $manager) {
        if ($manager->location) {
            $locationName = $manager->location->name;
        } else {
            $locationName = 'No Location';
            Log::info("Manager ID {$manager->id} does not have an associated location.");
        }
        Log::info("Manager ID: {$manager->id}, Name: {$manager->name}, Location: {$locationName}");
    }
    return response()->json($managers, 200);
}

    

    

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
  try {
    $validator = Validator ::make($request -> all(),[
      'name' => 'required|max:255',
      'location_id' => 'required|max:255'
    ]);
    if ($validator ->fails()){

      return response()->json($validator->errors(),422);
    }
    $manager = manager::create([
    'name' =>$request->name,
    'location_id' =>$request->location_id

    ]);
      return response()->json($manager,201);
  }catch(\Exception $e){
    return response()->json($e->getMessage());
  }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $manager = Manager::with('location')->findOrFail($id);
            return response()->json($manager);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }   
    }


    
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
{
  try {
    $validator = Validator::make($request -> all(),[
      'name' => 'required|max:255',
      'location_id' => 'required|max:255'
    ]);
    if ($validator ->fails()){

      return response()->json($validator->errors(),422);
    }

    $manager = manager::findOrFail($id);
    $manager ->update([
    'name' =>$request->name,
    'location_id' =>$request->location_id

    ]);
      return response()->json($manager,201);
  }catch(\Exception $e){
    return response()->json($e->getMessage());
  }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      try {
        $manager = manager::findOrFail($id);
        $manager->delete();
        return response()->json('Manager deleted successfully', 200);
    } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
  }
}
    

