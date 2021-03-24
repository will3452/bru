<?php

namespace App\Http\Controllers;

use App\AAN;
use App\Pen;
use App\User;
use App\Genre;
use Illuminate\Http\Request;

class CheckerController extends Controller
{
    public function aanChecker(){
        request()->validate([
            'aan'=>'required'
        ]);
        $aan = AAN::where('complete', request()->aan)->get();
        if(count($aan) && !$aan[0]->active){
            return 1;
        }


        return 0;
    }

    public function penChecker(){
        if(strlen(request()->name) == 0) {
            return [
                'msg'=>'this is required',
                'inputclass'=>'is-invalid',
                'alertclass'=>'alert-danger'
            ];
        }
        
        $pen = Pen::where('name',request()->name)->get();

        if(count($pen)){
            return [
                'msg'=>'pen is already in use.',
                'inputclass'=>'is-invalid',
                'alertclass'=>'alert-danger'
            ];
        }

        return [
            'msg'=>'Wow! Nice name.',
            'inputclass'=>'is-valid',
            'alertclass'=>'alert-success'
        ];
    }

    public function emailChecker(){
        if(strlen(request()->email) == 0) {
            return [
                'msg'=>'this is required.',
                'inputclass'=>'is-invalid',
                'alertclass'=>'alert-danger'
            ];
        }
        
        $user = User::where('email',request()->email)->get();

        if(count($user)){
            return [
                'msg'=>'Email is already in use.',
                'inputclass'=>'is-invalid',
                'alertclass'=>'alert-danger'
            ];
        }

        return [
            'msg'=>'Great! You may proceed.',
            'inputclass'=>'is-valid',
            'alertclass'=>'alert-success'
        ];
    }

    public function genreChecker(){
        $genre = Genre::where('name', request()->genre)->get()[0];
        if($genre->age_restriction) return ['age'=>'only'];
        $data['heats'] = $genre->heats;
        $data['violences'] = $genre->violences;
        return $data;
    }
}
