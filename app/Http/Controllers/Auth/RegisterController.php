<?php

namespace App\Http\Controllers\Auth;

use App\AAN;
use App\Bio;
use App\Http\Controllers\Controller;
use App\Interest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if (!Hash::check(Date('y-m-d'), $request->signature)) {
            abort(401);
        }

        $aan = request()->aan;
        $aans = AAN::where('complete', $aan);
        if ($aans && $aans->first()->user()->count() == 0) {
            return view('auth.register', compact('aan'));
        } else {
            abort(401);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => 'required|string',
            'sex' => 'required|string',
            'country' => 'required|string',
            'city' => 'required',
            'birthdate' => 'required|string',
            'aan' => '',
            // 'pencountry.0'=>'required',
            // 'pengender.0'=>'required',
            // 'penname.0'=>'unique:pens,name',
            'interest.*' => 'required',
            'file_url' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data['aan']);
        $aan = AAN::where('complete', $data['aan'])->get();
        // dd($aan[0]->id);

        $user = User::create([
            'aan_id' => $aan[0]->id,
            'first_name' => $data['first_name'],
            'role' => $data['role'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'picture' => $data['file_url'],
            'password' => Hash::make($data['password']),
        ]);
        $user->aan_string = request()->aan;
        $user->save();
        // dd($user);
        //pennames
        // Pen::create([
        //     'user_id'=>$user->id,
        //     'name'=>$data['penname'][0],
        //     'gender'=>$data['pengender'][0],
        //     'country'=>$data['pencountry'][0]
        // ]);
        // Pen::create([
        //     'user_id'=>$user->id,
        //     'name'=>$data['penname'][1],
        //     'gender'=>$data['pengender'][1],
        //     'country'=>$data['pencountry'][1]
        // ]);
        // Pen::create([
        //     'user_id'=>$user->id,
        //     'name'=>$data['penname'][2],
        //     'gender'=>$data['pengender'][2],
        //     'country'=>$data['pencountry'][2]
        // ]);

        // for($i = 0; $i < 3; $i++){
        //     if($data['penname'][$i] != null){
        //         Pen::create([
        //             'user_id'=>$user->id,
        //             'name'=>$data['penname'][$i],
        //             'gender'=>$data['pengender'][$i],
        //             'country'=>$data['pencountry'][$i]
        //         ]);
        //     }else{
        //         continue;
        //     }
        // }

        // Bio::
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

        return $user;
    }
}
