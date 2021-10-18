<?php

namespace App\Http\Controllers;

use App\Book;
use App\Chapter;
use App\User;
use Illuminate\Http\Request;

class ApiBookPreviewController extends Controller
{
    private function attachLikesAndComments($chapters)
    {
        $newChapters = collect([]);
        foreach ($chapters->data as $chapter) {
            $ch = Chapter::find($chapter->id);
            $chapter['likes'] = $ch->likes()->count();
            $chapter['comments'] = $ch->comments()->with('user')->latest()->get();
            $newChapters->push($chapter);
        }
        $chapters->data = $newChapters;
        return $chapters;
    }
    public function show($id)
    {
        $book = Book::find($id);
        $user = User::find(auth()->user()->id);

        if (!$user->isBookIsInTheBox($book->id)) {
            $chaptersId = $book->chapters()->get()->pluck('id');
            $chapters = $book->chapters()
                ->with('chapterPages')
                ->orderBy('sq')
                ->limit(1)
                ->paginate(1);
            return response([
                'chaptersId'=>$chaptersId,
                'chapters' => $this->attachLikesAndComments($chapters),
                'book_title' => $book->title,
                'book_author' => $book->author,
                'result' => 200,
            ], 200);
        }

        $chapters = $book->chapters()->orderBy('sq')->paginate(1);

        //check if the book read as whole
        if (request()->page) {
            if (request()->page == count($book->chapters)) {
                //count for homework
                $user->homework->complete_book = $user->homework->complete_book + 1;

                if ($book->class == 'spin-off') {
                    $user->homework->complete_spin_off = $user->homework->complete_spin_off + 1;
                }

                $user->homework->save();
            }
        }
        $chaptersId = $book->chapters()->get()->pluck('id');
        return response([
            'chaptersId'=>$chaptersId,
            'chapters' => $this->attachLikesAndComments($chapters),
            'book_title' => $book->title,
            'book_author' => $book->author,
            'result' => 200,
        ], 200);
    }

    public function getQuestionFeedbacks($id)
    {
        $book = Book::find($id);
        return response([
            'review_question_1' => $book->review_question_1,
            'review_question_2' => $book->review_question_2,
            'result' => 200,
        ], 200);
    }

    public function postFeedback($id)
    {
        $book = Book::find($id);
        $data = request()->validate([
            'message1' => 'required',
            'message2' => 'required',
            'stars' => '',
        ]);

        $user = User::find(auth()->user()->id);
        $comment1 = $book->comments()->create([
            'user_id' => $user->id,
            'message' => $data['message1'],
        ]);

        $comment2 = $book->comments()->create([
            'user_id' => $user->id,
            'message' => $data['message2'],
        ]);
        $star = $book->stars()->create(['value' => $data['stars'], 'user_id' => auth()->user()->id]);

        //update homework
        if ($star) {
            $user->homework->rate_book = $user->homework->rate_book + 1;
        }

        if ($comment1 && $comment2) {
            $user->homework->review_book = $user->homework->review_book + 1;
        }

        $user->homework->save();

        return response([
            'result' => 200,
        ], 200);
    }

    public function showChapter($id)
    {
        $chapter = Chapter::find($id);

        $comments = $chapter->comments()->with('user')->latest()->get();
        $hearts = $chapter->likes()->count();
        $stars = (int) $chapter->stars()->avg('value');

        return response([
            'result' => 200,
            'chapter' => $chapter,
            'comments' => $comments,
            'hearts' => $hearts,
            'stars' => $stars,
        ], 200);
    }
}
