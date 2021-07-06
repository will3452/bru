<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{
    public function pay(){
        $data = request()->validate([
            'amount'=>'required',
            'user_id'=>'required',
            'type'=>'required'
        ]);

        $user = User::find($data['id']);

        $source = Paymongo::source()->create([
            'type' => $data['type'],
            'amount' => $data['amount'],
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('payment.success'),
                'failed' => route('payment.failed')
            ],
            'billing'=>[
                'address'=>$user->bio->city.', '.$user->bio->country,
                'name'=>$user->full_name,
                'email'=>$user->email
            ]
        ]);

        return redirect($source->getRedirect()['checkout_url']);
    }


    public function success(){
        return 'success';
    }

    public function failed(){
        return 'failed';
    }
}
