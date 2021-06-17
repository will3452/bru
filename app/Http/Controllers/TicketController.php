<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use App\Song;
use App\Audio;
use App\Chapter;
use App\Podcast;
use App\Thrailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    public function correctPassword($password){
        return Hash::check($password, auth()->user()->password);
    }

    public function __construct(){
        $this->middleware('auth');
    }

    // books

    public function bookDestroy(Book $book){
        if(!$this->correctPassword(request()->password)) return 2;
        $book->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function bookUpdate(Book $book){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $book->tickets()->create($validated);
        return 1;
    }

    // arts
    public function artDestroy(Art $art){
        if(!$this->correctPassword(request()->password)) return 2;
        $art->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function artUpdate(Art $art){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $art->tickets()->create($validated);
        return 1;
    }

    //chapter
    public function chapterDestroy(Chapter $chapter){
        if(!$this->correctPassword(request()->password)) return 2;
        $chapter->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function chapterUpdate(Chapter $Chapter){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $Chapter->tickets()->create($validated);
        return 1;
    }

    // trailer 
    public function thrailerDestroy(Thrailer $thrailer){
        if(!$this->correctPassword(request()->password)) return 2;
        $thrailer->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function thrailerUpdate(Thrailer $thrailer){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $thrailer->tickets()->create($validated);
        return 1;
    }

    // audio
    public function audioDestroy(Audio $audio){
        if(!$this->correctPassword(request()->password)) return 2;
            $audio->tickets()->create([
                'reason'=>request()->reason,
                'delete'=>now(),
                'user_id'=>auth()->user()->id
            ]);

            return 1;
        }
        public function audioUpdate(Audio $audio){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $audio->tickets()->create($validated);
        return 1;
    }

    // song
    public function songDestroy(Song $song){
        if(!$this->correctPassword(request()->password)) return 2;
            $song->tickets()->create([
                'reason'=>request()->reason,
                'delete'=>now(),
                'user_id'=>auth()->user()->id
            ]);

            return 1;
    }
    public function songUpdate(Song $song){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $song->tickets()->create($validated);
        return 1;
    }


    // podcast
    public function podcastDestroy(Podcast $podcast){
        if(!$this->correctPassword(request()->password)) return 2;
            $podcast->tickets()->create([
                'reason'=>request()->reason,
                'delete'=>now(),
                'user_id'=>auth()->user()->id
            ]);

            return 1;
    }
    public function podcastUpdate(Podcast $podcast){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $podcast->tickets()->create($validated);
        return 1;
    }

}
