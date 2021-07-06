<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{
    public function gcash(){
        $data = request()->validate([
            'amount'=>'required',
            'user_id'=>'required'
        ]);

        $gcashSource = Paymongo::source()->create([
            'type' => 'gcash',
            'amount' => $data['amount'],
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('payment.success'),
                'failed' => route('payment.failed')
            ]
        ]);

        return redirect($gcashSource->getRedirect()['checkout_url']);
    }


    public function success(){
        return 'success';
    }

    public function failed(){
        return 'failed';
    }
}
