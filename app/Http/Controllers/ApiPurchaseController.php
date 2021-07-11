<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use App\User;
use Illuminate\Http\Request;

class ApiPurchaseController extends Controller
{

    public function museum(User $user, $work_id){
        $art = Art::find($work_id);
        $purple = $user->royalties->purple_crystal;
        if((int)$art->cost < (int)$purple){
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
        if((int)$book->cost < (int)$purple){
            $newbal = (int)$purple - (int)$book->cost;
            //process
            $user->royalties->update(['purple_crystal'=> $newbal]);

            //add to collection
            $user->box->books()->attach($work_id);
            return true;
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

        //museum 
        if($data['work_type'] == 'art'){
            $status = $this->museum($user, $data['work_id']);
        }else if($data['work_type'] == 'book'){
            $status = $this->library($user, $data['work_id']);
        }


        return response([
            'new_balance'=>$user->royalties,
            'status'=>$status,
            'result'=>200
        ], 200);
    }

    
}
