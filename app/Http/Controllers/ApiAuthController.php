<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function dayLogCreate(User $user)
    {
        if (!$user->daylogs()->whereDate('created_at', Carbon::today())->get()->count()) {
            $day = ($user->daylogs()->count() % 7) + 1;
            $user->daylogs()->create(['day' => $day]);
        }
    }

    public function createHomework($user)
    {
        if (!$user->homework()->count()) {
            $user->homework()->create([]);
        }
    }

    public function login()
    {
        $fields = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !\Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Creds',
                'result' => 500,
            ], 200);
            // return 'result=404';
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $avatar = Avatar::where('user_id', $user->id)->first();
        $college = $user->interests()->where('type', 'college')->first()->name;
        $royalties = [
            'hall_pass' => 0,
            'white_crystal' => 0,
            'silver_ticket' => 0,
            'purple_crystal' => 0,
        ];

        if ($user->royalties()->count() == 0) {
            $royalties = $user->royalties()->create($royalties);
        }

        $royalties = $user->royalties;

        //user
        $this->dayLogCreate($user);
        $this->createHomework($user);

        $response = [
            'user' => $user,
            'royalties' => $royalties,
            'avatar' => $avatar,
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
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
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

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
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

        $user->box()->create(); //create box for her/his collection
        $this->createHomework($user); //create homework

        $token = $user->createToken('myapptoken')->plainTextToken;
        $royalties = [
            'hall_pass' => 0,
            'white_crystal' => 0,
            'silver_ticket' => 0,
            'purple_crystal' => 0,
        ];

        //user
        $this->dayLogCreate($user);

        $user->royalties()->create($royalties);
        $response = [
            'user' => $user,
            'bio' => $user->bio,
            'royalties' => $royalties,
            'intererts' => $user->interests,
            'token' => $token,
            'result' => 200,
        ];

        return response($response, 201);
        // if($user){
        //     return 'result=200&token='.$token;
        // }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out',
        ];
    }
}
