<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::where( function($query) use ($request) {

            if($first_name = $request->first_name) {
                $query->where('first_name', 'like', '%'.$first_name.'%');
            }

            if($name = $request->name) {
                $query->where('name', 'like', '%'.$name.'%');
            }

            if($role = $request->role) {
                $query->where('role_id', $role);   
            }

            if($phone_number = $request->phone_number) {
                $query->where('phone_number', $phone_number);
            }

        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $roles = Role::all();

        $request->flash();
        
        return view('admin.users.index', ['users'=>$users, 'roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail($id);

        if($user->role->id === 2 || $user->role->id === 3) {
            $user->load(['orders', 'updatedBooks', 'addedBooks']);
            $addedBooks = $user->addedBooks();
            $updatedBooks = $user->updatedBooks();

            return view('admin.users.show', ['user'=>$user, 'addedBooks'=>$addedBooks, 'updatedBooks'=>$updatedBooks]);
        } else {
            $user->load(['orders']);
        }


        return view('admin.users.show', ['user'=>$user]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = array();

        if($user->role->id === 2 || $user->role->id === 3) {

            $user->load(['orders', 'updatedBooks', 'addedBooks'])->paginate(10);

            $addedBooks = $user->addedBooks()->paginate(10);
            $updatedBooks = $user->updatedBooks()->paginate(10);

            $data = ['user'=>$user, 'addedBooks'=>$addedBooks, 'updatedBooks'=>$updatedBooks];

        } else {
            $user->load('orders')->paginate(10);

            $data = ['user'=>$user];
        }

        // dd($data);
        return view('admin.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();


        return view('admin.users.edit', ['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return redirect()->route('admin-users.index');
    }
}
