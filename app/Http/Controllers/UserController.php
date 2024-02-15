<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegister;
use App\Jobs\sendmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // finding the all user from the table
        $admin = User::all();
        return view('admin.admindashboard', ['admins' => $admin]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // finding all role  in database and passing
        $roles = Role::all();
        return view('admin.createadmin', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRegister $request)
    {
        // validate request
        $data = $request->all();

        // encrypt password before save it into db

        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // adding to role table  using pivot table
        $admin->role()->attach($request->input('roles'));

        $user_roles = User::find($admin->id)->role->toArray();

        // dd($user_roles);

        // sending mail to user in that sending  email and password
        dispatch(new sendmail($data['email'], $data['password'], $user_roles[0]['name']));
        return redirect()->route('admin.dashboard')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // find user from the id
        $admins = User::find($id);

        // finding all the role from the role table
        $roles = Role::all()->toArray();

        // finding the role which was assign to user  and converting it in array format so that we can use it in our view page
        $user_roles = User::find($id)->role->toArray();
        return view('admin.adminedit', ['admins' => $admins, 'roles' => $roles, 'user_id' => $id, 'user_roles' => $user_roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRegister $request)
    {
        // finding the user from the user id
        $users = User::find($request->input('user_id'));

        // update the user  details
        $users->update($request->all());

        // syncing roles to the users
        $users->role()->sync($request->input('roles'));
        return redirect()->route('admin.dashboard')->with('success', 'User update successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // finding the user  from the given id and deleting it
        $admin = User::find($id);

        // Removeing the many to many relationship from the pivot table.
        $admin->role()->detach();

        //  delete the user from table.
        $admin->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User Delete successfully');
    }

    public function login()
    {
        // finding all role  in database and passing
        $role = Role::all();

        return view('user.login', ['roles' => $role]);
    }

    public function authenticate(Request $request)
    {
        // finding the user is our database or not.
        $admin = User::where('email', $request->input('email'))->first();

        // check if $admin is null then user was not found in our record.
        if (!$admin) {
            Session::flash('error', 'You are not Register! Please contact Superadmin');
            return redirect()->route('user.login');
        }

        // Finding Roles which was input by user
        $roles = $request->toArray()["roles"];

        // Finding the  roles of admin from the database that we have stored earlier.
        $user_id = $admin->role->pluck('id')->toArray();

        //
        if (in_array(intval($roles['0']), $user_id)) {

            if (Auth::attempt($request->only('email', 'password'))) {
                Session::flash('user', $admin->email);
                Session::flash('message', 'You are logged in!');

                switch (intval($roles['0'])) {
                    case 1:
                        return redirect()->route('user.dashboard', [$admin->name]);
                    case 2:
                        return redirect()->route('user.dashboard', [$admin->name]);
                    case 3:
                        return redirect()->route('superuser.dashboard', [$admin->name]);

                }
            } else {
                Session::flash('error', 'Email or Password is incorrect! Please try again');
                return redirect()->route('user.login');
            }
        } else {
            Session::flash('error', 'Please Select Your Allocated Roles to login');
            return redirect()->route('user.login');
        }

    }
}
