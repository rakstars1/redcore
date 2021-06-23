<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Resources\Users as UserResource;
use App\Http\Requests;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all users
        $users = User::all();
        //return as a resource
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //input users
        //if there is id, update else create new
        $user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;
        $user->id = $request->input('user_id');
        $user->fullName = $request->input('fullName');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->nominatedPassword = $request->input('nominatedPassword');

        if($user->save()){
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get single user by id
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get single user by id
        $user = User::findOrFail($id);

        if($user->delete()){
            return new UserResource($user);
        }
    }
}
