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

class ApiCommentController extends Controller
{
    public function sanitize($data)
    {
        unset($data['work_type']);
        unset($data['work_id']);
        unset($data['stars']);
        return $data;
    }

    public function storeArtComment($data)
    {
        $art = Art::find($data['work_id']);
        $art->stars()->create(['value'=>$data['stars'], 'user_id'=>auth()->user()->id]);
        $data = $this->sanitize($data);

        $comment = $art->comments()->create($data);

        return $comment;
    }

    public function storeAudioComment($data)
    {
        $work = Audio::find($data['work_id']);
        $work->stars()->create(['value'=>$data['stars'],'user_id'=>auth()->user()->id]);
        $data = $this->sanitize($data);
        $comment = $work->comments()->create($data);

        return $comment;
    }

    public function storeSongComment($data)
    {
        $work = Song::find($data['work_id']);
        $work->stars()->create(['value'=>$data['stars'],'user_id'=>auth()->user()->id]);
        $data = $this->sanitize($data);

        $comment = $work->comments()->create($data);

        return $comment;
    }

    public function storePodcastComment($data)
    {
        $work = Podcast::find($data['work_id']);
        $work->stars()->create(['value'=>$data['stars'],'user_id'=>auth()->user()->id]);
        $data = $this->sanitize($data);

        $comment = $work->comments()->create($data);

        return $comment;
    }

    public function storeFilmComment($data)
    {
        $work = Thrailer::find($data['work_id']);
        $work->stars()->create(['value'=>$data['stars'],'user_id'=>auth()->user()->id]);
        $data = $this->sanitize($data);

        $comment = $work->comments()->create($data);

        return $comment;
    }

    public function getComments(Request $request)
    {
        $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);

        $comments = [];
        $hearts = 0;
        $stars = 0;

        if ($request->work_type == 'chapter') {
            if (Chapter::find($request->work_id)) {
                $comments = Chapter::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Chapter::find($request->work_id)->likes()->count();
                $stars = (int)Chapter::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'book') {
            if (Book::find($request->work_id)) {
                $comments = Book::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Book::find($request->work_id)->likes()->count();
                $stars = (int)Book::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'audio') {
            if (Audio::find($request->work_id)) {
                $comments = Audio::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Audio::find($request->work_id)->likes()->count();
                $stars = (int)Audio::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'film') {
            if (Thrailer::find($request->work_id)) {
                $comments = Thrailer::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Thrailer::find($request->work_id)->likes()->count();
                $stars = (int)Thrailer::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'podcast') {
            if (Podcast::find($request->work_id)) {
                $comments = Podcast::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Podcast::find($request->work_id)->likes()->count();
                $stars = (int)Podcast::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'song') {
            if (Song::find($request->work_id)) {
                $comments = Song::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Song::find($request->work_id)->likes()->count();
                $stars = (int)Song::find($request->work_id)->stars()->avg('value');
            }
        }
        if ($request->work_type == 'art') {
            if (Art::find($request->work_id)) {
                $comments = Art::find($request->work_id)->comments()->with('user')->latest()->get();
                $hearts = Art::find($request->work_id)->likes()->count();
                $stars = (int)Art::find($request->work_id)->stars()->avg('value');
            }
        }

        foreach ($comments as $comment) {
            $comment->str_date = $comment->created_at->diffForHumans();
        }

        return response([
            'hearts'=> $hearts,
            'comments'=>$comments,
            'stars'=>$stars,
            'size'=>count($comments ?? []),
            'result'=>200
        ], 200);
    }

    public function storeChapterComment($data)
    {
        $chapter = Chapter::find($data['work_id']);
        if ($data['stars'] != -1) {
            $chapter->stars()->create(['value'=>$data['stars'], 'users_id'=>auth()->user()->id]);
        }
        $data = $this->sanitize($data);

        $comment = $chapter->comments()->create($data);

        return $comment;
    }

    public function storeComment(Request $request)
    {
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required',
            'message'=>'required',
            'stars'=>'',
            'reply_to'=>''
        ]);

        if (!isset($request->stars)) {
            $data['stars'] = -1;
        }

        $userId = auth()->user()->id;
        $data['user_id'] = $userId;
        $comment = null;
        $numberOfComments = 0;
        if ($request->work_type == 'chapter') {
            $numberOfComments = Chapter::find($data['work_id'])->comments()->count();
            $comment = $this->storeChapterComment($data);
        } elseif ($request->work_type == 'art') {
            $numberOfComments = Art::find($data['work_id'])->comments()->count();
            $comment = $this->storeArtComment($data);
        } elseif ($request->work_type == 'audio') {
            $numberOfComments = Audio::find($data['work_id'])->comments()->count();
            $comment = $this->storeAudioComment($data);
        } elseif ($request->work_type == 'song') {
            $numberOfComments = Song::find($data['work_id'])->comments()->count();
            $comment = $this->storeSongComment($data);
        } elseif ($request->work_type == 'podcast') {
            $numberOfComments = Podcast::find($data['work_id'])->comments()->count();
            $comment = $this->storePodcastComment($data);
        } elseif ($request->work_type == 'film') {
            $numberOfComments = Thrailer::find($data['work_id'])->comments()->count();
            $comment = $this->storeFilmComment($data);
        }

        return response([
            'number_of_comments'=>$numberOfComments,
            'comment'=>$comment,
            'result'=>200
        ], 200);
    }
}
