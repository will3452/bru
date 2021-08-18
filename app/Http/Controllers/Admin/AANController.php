<?php

namespace App\Http\Controllers\Admin;

use App\AAN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AANController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'checkrole:aan']);
    }

    public function store()
    {
        $aan = auth()->guard('admin')->user()->aans()->create([]);
        $aan->complete = now()->format('ydm') . str_pad($aan->id, 8, '0', STR_PAD_LEFT);
        $aan->save();
        return back()->withAan(now()->format('ydm') . str_pad($aan->id, 8, '0', STR_PAD_LEFT));
    }

    public function index()
    {
        $aans = AAN::with(['admin', 'user'])->get();

        return view('admin.aan', compact('aans'));
    }

    public function destroy($id)
    {
        request()->validate([
            'password' => 'required',
        ]);
        if (Hash::check(request()->password, $this->guard()->user()->password)) {
            $aan = AAN::findOrFail($id);
            $aan->delete();
            return back()->withSuccess('Done');
        } else {
            return abort(401);
        }

    }

    public function guard()
    {
        return Auth::guard('admin');
    }
}
