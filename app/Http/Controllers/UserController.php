<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        
        $new_user = new \App\Models\User;

        $email = $request->get('email');
        $full_name = $request->get('full_name');
        $role = $request->get('role');
        $school_id = Auth::user()->school_id;
        $unhashed_password = mt_rand();
        $password = Hash::make($unhashed_password);

        $check_email = DB::select("select * from users where email = '".$email."'");
        if ($check_email) {
            return redirect('users')->with('error', 'User with email '.$email.' already exists! Please try another email');
        }

        $new_user->email = $email;
        $new_user->username = $email;
        $new_user->password = $password;
        $new_user->school_id = $school_id;
        $new_user->role = $role;
        if ($new_user->save()) {

            $data = [
                'email' => $email,
                'password' => $unhashed_password,
                'school_id' => $school_id,
                'full_name' => $full_name,
            ];

            Mail::send('mail', $data, function($message) use ($data) {
               $message->to( $data['email'] , $data['full_name'])->subject('Login Information')->from('khoirkamaludin@gmail.com','Smartschool');
            });

            if ($role == 'TEACHER') {
                $new_teacher = new \App\Models\Teacher;
                $new_teacher->full_name = $full_name;
                $new_teacher->user_id = $new_user->id;

                if ($new_teacher->save()) {
                    return redirect('users')->with('success', 'Teacher with email '.$email.' invited successfully! Make sure the added teacher check the login information sent to his email!');
                }
            }
            if ($role == 'STUDENT') {
                $new_student = new \App\Models\Student;
                $new_student->full_name = $full_name;
                $new_student->user_id = $new_user->id;
                if ($new_student->save()) {
                    return redirect('users')->with('success', 'Student with email '.$email.' invited successfully! Make sure the added student check the login information sent to his email!');
                }
            }
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
            return redirect('users')->with('success', 'User '.$user->username.' updated successfully');
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
                $user_role = $user->school_admin;
            }
            if ($user->role == 'TEACHER') {
                $user_role = $user->teacher;
            }
            if ($user->role == 'STUDENT') {
                $user_role = $user->student;
            }

            if ($user_role->delete()) {
                return redirect('users')->with('success', 'User '.$user->username.' deleted successfully');
            }
        }
    }
}
