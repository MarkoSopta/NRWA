<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\users;
use App\Http\Requests\StoreusersRequest;
use App\Http\Requests\UpdateusersRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use App\Services\userQuery;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return users::all();

        /*
        
        $filter = new userQuery();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0){
            
            return new UserCollection(users::paginate());
        }else {
            return new UserCollection(users::where($queryItems)->paginate());
        }

        
        */

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
    public function store(StoreusersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(users $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateusersRequest $request, users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(users $users)
    {
        //
    }
}
