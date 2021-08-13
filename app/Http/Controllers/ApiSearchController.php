<?php

namespace App\Http\Controllers;

use App\Art;
use App\Audio;
use App\Book;
use App\Podcast;
use App\Song;
use App\Thrailer;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = request()->validate([
            'type' => 'required',
        ]);

        $return = [];

        switch ($data['type']) {
            case 'book':
                $return = Book::get();
                break;
            case 'film':
                $return = Thrailer::get();
                break;
            case 'song':
                $return = Song::get();
                break;
            case 'podcast':
                $return = Podcast::get();
                break;
            case 'art':
                $return = Art::get();
                break;
            case 'audio':
                $return = Audio::get();
                break;
        }

        return response([
            'item' => $return,
            'result' => 200,
        ], 200);

    }
}
