<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{

    
    public function pay(){
        $data = request()->validate([
            'amount'=>'required',
            'user_id'=>'required',
            'type'=>'required',
            'for'=>'required'
        ]);

        // security
        $pattern = now()->format('m-y').$data['user_id'].$data['amount'];
        $data['hash'] = Hash::make($pattern);

        $success = route('payment.success',$data);
        $failed = route('payment.failed');

        $user = User::find($data['user_id']);

        $source = Paymongo::source()->create([
            'type' => $data['type'],
            'amount' => $data['amount'],
            'currency' => 'PHP',
            'redirect' => [
                'success' => $success,
                'failed' => $failed
            ],
            'billing'=>[
                'name'=>$user->full_name,
                'email'=>$user->email
            ]
        ]);

        return redirect($source->getRedirect()['checkout_url']);
    }


    public function success(){
        $data = request()->validate([
            'amount'=>'required',
            'user_id'=>'required',
            'type'=>'required',
            'for'=>'required',
            'hash'=>'required'
        ]);

        $pattern = now()->format('m-y').$data['user_id'].$data['amount'];
        if(! Hash::check($pattern, $data['hash'])){
            abort(419);
        }
        $user = User::find(request()->user_id);
        
        $user->invoices()->create([
            'amount'=>request()->amount, 
            'from_name'=>$user->full_name,
            'from_email'=>$user->email, 
            'type'=>request()->type, 
            'desc'=>request()->for ?? '',
            'status'=>'paid'
        ]);
        return 'success';
    }

    public function failed(){
        return 'failed';
    }
}
