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
            'keyword' => 'required',
        ]);

        $return = [];

        switch ($data['type']) {
            case 'book':
                $return = Book::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
            case 'film':
                $return = Thrailer::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
            case 'song':
                $return = Song::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
            case 'podcast':
                $return = Podcast::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
            case 'art':
                $return = Art::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
            case 'audio':
                $return = Audio::where('title', 'like', '%' . $data['keyword'] . '%')->get();
                break;
        }

        return response([
            'item' => $return,
            'result' => 200,
        ], 200);

    }
}
