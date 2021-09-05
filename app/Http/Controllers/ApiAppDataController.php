<?php

namespace App\Http\Controllers;

use App\AppData;
use Illuminate\Http\Request;

class ApiAppDataController extends Controller
{
    public function get(Request $request)
    {
        $request->validate([
            'key' => 'required',
        ]);

        $data = AppData::where('key', $request->key)->first();

        $data['value'] = "/storage/" . $data['value'];

        return response([
            'data' => $data,
            'result' => 200,
        ], 200);

    }
}
