<?php

namespace App\Http\Controllers;

use App\Bio;
use App\Interest;
use App\User;

class PreregisterController extends Controller
{
    public function index()
    {
        return view('student-register');
    }

    public function save()
    {

        $data = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => 'required|string',
            'sex' => 'required|string',
            'country' => 'required|string',
            'city' => 'required',
            'birthdate' => 'required|string',
            'interest.*' => 'required',
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'role' => 'student',
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Bio::create([
            'user_id' => $user->id,
            'gender' => $data['gender'],
            'sex' => $data['sex'],
            'birthdate' => $data['birthdate'],
            'country' => $data['country'],
            'city' => ucwords($data['city']),
        ]);

        //interest
        $i1 = explode('@', $data['interest'][0]);

        Interest::create([
            'user_id' => $user->id,
            'type' => 'college',
            'name' => $i1[0],
            'description' => end($i1),
        ]);

        $i2 = explode('@', $data['interest'][1]);

        Interest::create([
            'user_id' => $user->id,
            'type' => 'course',
            'name' => $i2[0],
            'description' => end($i2),
        ]);

        $i3 = explode('@', $data['interest'][2]);

        Interest::create([
            'user_id' => $user->id,
            'type' => 'club',
            'name' => $i3[0],
            'description' => end($i3),
        ]);

        $user->box()->create();

        return 'registered successfully!';
    }
}
