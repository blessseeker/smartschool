<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $school_id = Auth::user()->school_id;
        $users = \App\Models\User::where('school_id', $school_id)->get();

        if (Auth::user()->role === 'ADMIN') {
            return view('users.admin', compact('users'));
        } else {
            return view('users.teacher_student', compact('users'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->role == 'ADMIN') {
            $school_admin = $user->school_admin;
            $school_admin->full_name = $request->get('full_name');
            $school_admin->save();
        }
        $user->password = Hash::make($request->get('password'));
        if ($user->save()) {
            return redirect('users')->with('status', 'User '.$user->username.' updated successfully');
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
        $user = \App\Models\User::findOrFail($id);
        
        if ($user->delete()) {
            if ($user->role == 'ADMIN') {
                $school_admin = $user->school_admin;
                $school_admin->delete();
            }
            return redirect('users')->with('status', 'User '.$user->username.' deleted successfully');
        }
    }
}
