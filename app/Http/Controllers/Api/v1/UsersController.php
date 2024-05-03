<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\users;
use App\Http\Requests\v1\UpdateUsersRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\Http\Resources\v1\UserCollection;
use Illuminate\Http\Request;
use App\Services\userQuery;
use App\Http\Requests\v1\StoreUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {      
        
        return new UserCollection(users::paginate());
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        return new UserResource(users::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(users $user)
    {
        return new UserResource($user);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, users $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(users $users)
    {
        //
    }
}
