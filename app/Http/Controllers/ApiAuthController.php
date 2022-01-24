<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function dayLogCreate(User $user)
    {
        if (!$user->daylogs()->whereDate('created_at', Carbon::today())->get()->count()) {
            $day = ($user->daylogs()->count() % 7) + 1;
            $user->daylogs()->create(['day' => $day]);
        }
    }

    public function open()
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            return response([
                'result' => 404
                , 200]);
        }

        $avatar = Avatar::where('user_id', $user->id)->first();
        $college = $user->interests()->where('type', 'college')->first()->name;

        $royalties = $user->royalties;

//user
        $this->dayLogCreate($user);

        $response = [
            'user' => $user,
            'royalties' => $royalties,
            'avatar' => $avatar ?? null,
            'bio' => $user->bio,
            'interests' => $user->interests,
            'college' => $college,
            'result' => 200,
        ];

        return response($response, 200);
    }

    public function login()
    {
        $fields = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Creds',
                'result' => 500,
            ], 200);
            // return 'result=404';
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $avatar = Avatar::where('user_id', $user->id)->first();
        $college = $user->interests()->where('type', 'college')->first()->name;

        $royalties = $user->royalties;

        //user
        $this->dayLogCreate($user);

        $response = [
            'user' => $user,
            'royalties' => $royalties,
            'avatar' => $avatar ?? null,
            'bio' => $user->bio,
            'interests' => $user->interests,
            'college' => $college,
            'token' => $token,
            'result' => 200,
        ];
        // if($user){
        //     return 'result=200&token='.$token;
        // }

        return response($response, 200);
    }

    public function register(Request $request)
    {
        $fields = request()->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'sex' => 'required',
            'gender' => 'required',
            'college' => 'required',
            'course' => 'required',
            'club' => 'required',
            'country' => 'required',
            'city' => '',
            'birthdate' => 'required',
            'bruname' => 'required',
            'room' => '',
        ]);

        $emailExist = User::where('email', $request->email)->get();
        if (count($emailExist)) {
            return response([
                'alert' => 'email is already in used!',
                'result' => 404,
            ], 200);
        }

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
            'bruname' => $request->bruname,
            'room' => $request->room ?? '',
        ]);

        $user->bio()->create([
            'gender' => $request->gender,
            'sex' => $request->sex,
            'birthdate' => $request->birthdate,
            'country' => $request->country,
            'city' => '',
        ]);

        $user->interests()->create([
            'type' => 'course',
            'name' => $request->course,
        ]);

        $user->interests()->create([
            'type' => 'college',
            'name' => $request->college,
        ]);
        $user->interests()->create([
            'type' => 'club',
            'name' => $request->club,
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        //user
        $this->dayLogCreate($user);

        $response = [
            'user' => $user,
            'bio' => $user->bio,
            'royalties' => $user->royalties,
            'interests' => $user->interests,
            'token' => $token,
            'result' => 200,
            'alert' => 'success',
        ];

        return response($response, 201);
        // if($user){
        //     return 'result=200&token='.$token;
        // }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logged out',
            'result' => 200,
        ], 200);
    }

    public function updateRoom()
    {
        $data = request()->validate([
            'room' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        $user->room = $data['room'];
        $user->save();

        return response([
            'room_updated' => $user->room,
            'result' => 200,
        ], 200);
    }
}
