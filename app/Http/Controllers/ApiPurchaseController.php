<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use App\Song;
use App\User;
use App\Audio;
use App\Podcast;
use App\Thrailer;
use Illuminate\Http\Request;

class ApiPurchaseController extends Controller
{

    public function museum(User $user, $work_id){
        $art = Art::find($work_id);
        $purple = $user->royalties->purple_crystal;
        if((int)$art->cost <= (int)$purple){
            $newbal = (int)$purple - (int)$art->cost;
            //process
            $user->royalties->update(['purple_crystal'=> $newbal]);

            //add to collection
            $user->box->arts()->attach($work_id);
            return true;
        }
        return false;
    }

    public function library(User $user, $work_id){
        $book = Book::find($work_id);
        $purple = $user->royalties->purple_crystal;
        if((int)$book->cost <= (int)$purple){
            $newbal = (int)$purple - (int)$book->cost;
            //process
            $user->royalties->update(['purple_crystal'=> $newbal]);

            //add to collection
            $user->box->books()->attach($work_id);
            return true;
        }
        return false;
    }

    public function audio(User $user, $work_id){
        $book = Audio::find($work_id);
        $purple = $user->royalties->purple_crystal;
        if((int)$book->cost <= (int)$purple){
            $newbal = (int)$purple - (int)$book->cost;
            //process
            $user->royalties->update(['purple_crystal'=> $newbal]);

            //add to collection
            $user->box->audios()->attach($work_id);
            return true;
        }
        return false;
    }

    public function podcast(User $user, $work_id){
        $book = Podcast::find($work_id);
        $purple = $user->royalties->purple_crystal;
        if((int)$book->cost <= (int)$purple){
            $newbal = (int)$purple - (int)$book->cost;
            //process
            $user->royalties->update(['purple_crystal'=> $newbal]);

            //add to collection
            $user->box->podcasts()->attach($work_id);
            return true;
        }
        return false;
    }

    public function film(User $user, $work_id){
        $film = Thrailer::find($work_id);
        if($film->gem == 'White'){
            $bal = $user->royalties->white_crystal;
            if((int)$film->cost <= (int)$bal){
                $newbal = (int)$bal - (int)$film->cost;

                $user->royalties->update(['white_crystal'=>$newbal]);

                $user->box->films()->attach($work_id);
                return true;
            }
        }else {
            $bal = $user->royalties->purple_crystal;
            if((int)$film->cost <= (int)$bal){
                $newbal = (int)$bal - (int)$film->cost;

                $user->royalties->update(['purple_crystal'=>$newbal]);

                $user->box->films()->attach($work_id);
                return true;
            }
        }
        return false;
    }

    public function song(User $user, $work_id){
        $song = Song::find($work_id);
        if($song->cost_type != 'purple'){
            $bal = $user->royalties->white_crystal;
            if((int)$song->cost <= (int)$bal){
                $newbal = (int)$bal - (int)$song->cost;

                $user->royalties->update(['white_crystal'=>$newbal]);

                $user->box->songs()->attach($work_id);
                return true;
            }
        }else {
            $bal = $user->royalties->purple_crystal;
            if((int)$song->cost <= (int)$bal){
                $newbal = (int)$bal - (int)$song->cost;

                $user->royalties->update(['purple_crystal'=>$newbal]);

                $user->box->songs()->attach($work_id);
                return true;
            }
        }
        return false;
    }

    public function purchaseWork(Request $request){
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);

        $user = User::find(auth()->user()->id);
        
        $status = false;

        if($data['work_type'] == 'art'){
            $status = $this->museum($user, $data['work_id']);
        }else if($data['work_type'] == 'book'){
            $status = $this->library($user, $data['work_id']);
        }else if($data['work_type'] == 'film'){
            $status = $this->film($user, $data['work_id']);
        }if($data['work_type'] == 'audio'){
            $status = $this->audio($user, $data['work_id']);
        }
        if($data['work_type'] == 'podcast'){
            $status = $this->podcast($user, $data['work_id']);
        }if($data['work_type'] == 'song'){
            $status = $this->song($user, $data['work_id']);
        }


        return response([
            'new_balance'=>$user->royalties,
            'status'=>$status,
            'result'=>200
        ], 200);
    }


    public function previewWork(Request $request){
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);

        $user = User::find(auth()->user()->id);
        
        $status = false;

        if($request->work_type == 'film'){
            //always white interms of preview
            $film = Thrailer::find($data['work_id']);
            $bal = $user->royalties->white_crystal;
            if((int)$film->preview_cost <= (int)$bal){
                $newbal = (int)$bal - (int)$film->preview_cost;
                $user->royalties->update(['white_crystal'=>$newbal]);
                $status = true;
            }
        }


        return response([
            'new_balance'=>$user->royalties,
            'status'=>$status,
            'result'=>200
        ], 200);
    }

    
}
