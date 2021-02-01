<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Events\ActivityLogEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\customEditUserRequest;
use App\Http\Requests\customCreateUserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsersController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        $title = 'itrack - Users';
        return view('users.index', compact('title', 'users'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "itrack - Add New User";
        return view('users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customCreateUserRequest $request)
    {

        $newUserCreated = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'password' => Hash::make($request->password),
        ]);

        $description = "Created User: Name:" . $newUserCreated->name . ", Email:" . $newUserCreated->email . ", Designation:" . $newUserCreated->designation . " at " . Carbon::now();
        return $newUserCreated && event(new ActivityLogEvent($newUserCreated, 'Create User', $description)) ? redirect()->route('users.index')
            ->with('success', 'New user creadted succesfully!') :
            back()->with('error', 'Action failed. Something might be wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "itrack - View User Details";
        $user = User::findOrFail($id);
        return view('users.show', compact('title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "itrack - View User Details";
        $user = User::findOrFail($id);
        return view('users.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customEditUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $oldName = $user->name;
            $oldEmail = $user->email;
            $oldDesignation = $user->designation;
            $oldPassword = $user->password;

            $name = '';
            $email = '';
            $designation = '';
            $password = '';

            if (!is_null($request->email) && User::where('id', $id)->where('email', $request->email)->doesntExist()) {
                return back()->with('error', 'Sorry, this eamil is taken!');
            } else {


                $user->name = $request->name;
                $user->email = $request->email;
                $user->designation = $request->designation;


                //We must be sure to update the password accordingly, since the user might be a supradmin who
                //in this case cannot change the password

                if (!$request->has('password') && is_null($request->password)) {
                    $user->password = $oldPassword;
                } elseif ($request->has('password') && !is_null($request->password) && strlen($request->password) < 8) {
                    //we shall check for the length if the user decides to change the password
                    return back()->with('password_error', 'Password length must be atleast 8 characters long');
                } else {
                    $user->password =  Hash::make($request->password);
                }


                if ($user->name !== $oldName) {
                    $name = 'Changed name from ' . $oldName . ' to ' . $user->name;
                } else {
                    $name = 'Name was not changed';
                }

                if ($user->email !== $oldEmail) {
                    $email = ',changed email from ' . $oldEmail . ' to ' . $user->email;
                } else {
                    $email = ',email was not changed';
                }

                if ($user->designation !== $oldDesignation) {
                    $designation = ',changed designation from ' . $oldDesignation . ' to ' . $user->designation;
                } else {
                    $designation = ',designation was not changed';
                }

                if ($user->password !== $oldPassword) {
                    $password = ',password was changed';
                } else {
                    $password = ',but password was not changed';
                }

                $description = 'Updated user details -' . $name . ' ' . $email . ' ' . $designation . ' ' . $password . " at " . Carbon::now();
                return $user->save() && event(new ActivityLogEvent($user, 'Updated User Details', $description)) ? back()->with('success', 'Updated user details successfully!') : back()->with('error', 'Action failed. Please try again');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $oldUser = $user->name;
        $description = "User " . $oldUser . " was deleted by " . Auth::user()->name . " at " . Carbon::now();
        return  $user->delete() && event(new ActivityLogEvent($user, 'Delete User', $description)) ?
            redirect()->route('users.index')->with('success', 'User deleted successfully') :
            back()->with('error', 'Action failed. Something might be wrong');
    }

    /**
     * Block the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function blockUser($id)
    {
        $user = User::find($id);
        $activity = '';
        if ($user->is_blocked) {
            $user->is_blocked = false;
            $activity = 'unblocked';
        } else {
            $user->is_blocked = true;
            $activity = 'blocked';
        }
        $description = $user->name . " " . $activity . " at " . Carbon::now();
        return  $user->save() && event(new ActivityLogEvent($user, 'Block User', $description)) ?
            back()->with('success', 'User blocked successfully') :
            back()->with('error', 'Action failed. Something might be wrong');
    }
}
