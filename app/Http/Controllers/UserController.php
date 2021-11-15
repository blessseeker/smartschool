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

        // Check authenticated user
        if (!Auth::check()) {
            return redirect('login');
        }

        // fetch users list from school
        $school_id = Auth::user()->school_id;
        $users = \App\Models\User::where('school_id', $school_id)->get();

        // if user role is admin, return admin page. If not, return teachers & students list page
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
        // check authentication
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->role != 'ADMIN') {
            return redirect('users')->with('error', 'You dont have permission to do this action!');
        }
        
        // Load user model
        $new_user = new \App\Models\User;

        // defining required variables
        $email = $request->get('email');
        $full_name = $request->get('full_name');
        $role = $request->get('role');
        $school_id = Auth::user()->school_id;
        $unhashed_password = mt_rand();
        $password = Hash::make($unhashed_password);

        // check if email already registered
        $check_email = DB::select("select * from users where email = '".$email."'");
        if ($check_email) {
            return redirect('users')->with('error', 'User with email '.$email.' already exists! Please try another email');
        }

        // Saving new user
        $new_user->email = $email;
        $new_user->username = $email;
        $new_user->password = $password;
        $new_user->school_id = $school_id;
        $new_user->role = $role;
        if ($new_user->save()) {

            // Sending email to new user
            $data = [
                'email' => $email,
                'password' => $unhashed_password,
                'school_id' => $school_id,
                'full_name' => $full_name,
            ];

            Mail::send('mail', $data, function($message) use ($data) {
               $message->to( $data['email'] , $data['full_name'])->subject('Login Information')->from('khoirkamaludin@gmail.com','Smartschool');
            });

            // If the new account is a teacher, load teacher model
            if ($role == 'TEACHER') {
                $new_person = new \App\Models\Teacher;
            }

            // If new account is a student, load student model
            if ($role == 'STUDENT') {
                $new_person = new \App\Models\Student;
            }

            // Save personal data to db
            $new_person->full_name = $full_name;
            $new_person->user_id = $new_user->id;

            if ($new_person->save()) {
                return redirect('users')->with('success', 'Teacher with email '.$email.' invited successfully! Make sure the added teacher check the login information sent to his email!');
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

        // Check authenticated user
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->role != 'ADMIN') {
            return redirect('users')->with('error', 'You dont have permission to do this action!');
        }

        // Find user
        $user = \App\Models\User::findOrFail($id);

        // Edit personal data depends on user role
        if ($user->role == 'ADMIN') {
            $person = $user->school_admin;
        }
        if ($user->role == 'TEACHER') {
            $person = $user->teacher;
        }
        if ($user->role == 'STUDENT') {
            $person = $user->student;
        }
        $person->full_name = $request->get('full_name');
        $person->save();

        // Hash password and save
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

        // Check authenticated user
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->role != 'ADMIN') {
            return redirect('users')->with('error', 'You dont have permission to do this action!');
        }
        // Find user
        $user = \App\Models\User::findOrFail($id);
        
        // Delete user data and determine user role
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

            //  Delete personal data
            if ($user_role->delete()) {
                return redirect('users')->with('success', 'User '.$user->username.' deleted successfully');
            }
        }
    }
}
