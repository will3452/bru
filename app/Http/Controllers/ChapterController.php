<?php

namespace App\Http\Controllers;

use App\Book;
use App\Chapter;
use App\ChapterPage;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\StoreNovelFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Book $book)
    {
        return view('chapters.index', compact('book'));
    }

    public function create(Book $book)
    {
        if ($book->category == 'Series') {
            $selection_books = Book::where('series_id', null)->where('id', '!=', $book->id)->whereNotNull('publish_date')->get();
            return view('chapters.series_create', compact(['book', 'selection_books']));
        }
        $categories = ['Novel', 'Anthology'];
        if (in_array($book->category, $categories)) {
            return view('chapters.novel_create', compact('book'));
        } else {
            return view('chapters.create', compact('book'));
        }
    }

    public function storeNovel(StoreNovelFormRequest $request, Book $book)
    {
        // dd($request->validated());

        $validated = $request->validated();
        if (!isset($validate['cost'])) {
            $validated['cost'] = 1;
        }
        if (isset($validated['cpy']) && $validated['cpy'] == 'on') {
            $validated['cpy'] = now();
        }
        // dd($validated);
        $chapter = $book->chapters()->create($validated);
        toast('Chapter Added!', 'success');
        return redirect()->route('books.show', $book);
    }

    public function storeSeries(Book $book)
    {
        request()->validate([
            'books.*' => '',
        ]);
        Book::whereIn('id', request()->books)->update(['series_id' => $book->id]);

        return redirect()->route('books.show', $book)->withSuccess('Done');
    }

    public function store(StoreChapterRequest $request, Book $book)
    {
        $validated = $request->validated();
        $validated['cpy'] = now();
        $chapter = $book->chapters()->create($validated);
        return redirect()->route('books.show', $book)->withSuccess('Done');
    }

    public function removeSeries(Book $book, Book $b1)
    {
        $b1->series_id = null;
        $b1->save();
        return back()->withSuccess('Remove Done!');
    }

    public function removeNovel(Book $book, Chapter $chapter)
    {
        Storage::delete($chapter->opath);
        $chapter->delete();
        return back()->withSuccess('Done');
    }

    public function show(Book $book, Chapter $chapter)
    {
        return view('chapters.show', compact('book', 'chapter'));
    }

    public function destroy(Book $book, Chapter $chapter)
    {
        Storage::delete($chapter->opath);
        Storage::delete($chapter->ocontent);
        $chapter->delete();
        return back()->withSuccess('Done');
    }

    public function update(Book $book, Chapter $chapter)
    {
        if (request()->has('art_cost')) {
            $chapter->art_cost = request()->art_cost;
        }
        if ($book->category == 'Novel' || $book->category == 'Anthology') {
            if (request()->has('art_cost')) {
                $chapter->art_cost = request()->art_cost;
            }
            $chapter->content = request()->content_x;
        } else {
            if (request()->has('chapter_content')) {
                Storage::delete($chapter->ocontent);
                $chapter_path = request()->chapter_content->store('public/chapter_content');
                $chapter_arrpath = explode('/', $chapter_path);
                $chapter_endpath = end($chapter_arrpath);
                $chapterx = '/storage/chapter_content/' . $chapter_endpath;
                $chapter->content = $chapterx;
            }
        }
        $chapter->foot_note = request()->foot_note;
        toast('Chapter updated!', 'success');
        $chapter->save();
        return back()->withSuccess('Done!');
    }

    public function chapterPageCreate($id)
    {
        $chapter = Chapter::findOrFail($id);
        $episode = $chapter->chapterPages()->count() + 1;
        return view('chapters.page', ['chapter_id'=>$id, 'episode'=>$episode]);
    }

    public function chapterPageShow($id)
    {
        $page = ChapterPage::findOrFail($id);
        return view('chapters.show_page', compact('page'));
    }

    public function chapterPageUpdate($id)
    {
        $page = ChapterPage::findOrFail($id);
        request()->validate([
            'content'=>'required'
        ]);

        $chapter_path = request()->content->store('public/chapter_content');
        $chapter_arrpath = explode('/', $chapter_path);
        $chapter_endpath = end($chapter_arrpath);
        $content = '/storage/chapter_content/' . $chapter_endpath;

        $page->update([
            'content'=>$content,
        ]);
        toast('page was updated successfully!', 'success');
        return back();
    }

    public function chapterPageStore()
    {
        request()->validate([
            'content'=>'required',
            'chapter_id'=>'required'
        ]);

        $chapter_path = request()->content->store('public/chapter_content');
        $chapter_arrpath = explode('/', $chapter_path);
        $chapter_endpath = end($chapter_arrpath);
        $content = '/storage/chapter_content/' . $chapter_endpath;

        $chapterPage = ChapterPage::create([
            'chapter_id'=>request()->chapter_id,
            'content'=>$content,
        ]);

        toast('page was uploaded successfully!', 'success');
        return back();
    }

    public function chapterPageIndex($id)
    {
        $chapter = Chapter::find($id);
        $chapter->load('chapterPages');
        return view('chapters.index_page', compact('chapter'));
    }

    public function chapterPageDelete($id)
    {
        $page = ChapterPage::findOrFail($id);
        $chapter = Chapter::findOrFail($page->chapter_id);
        $book = Book::findOrFail($chapter->book_id);

        if ($book->user_id != auth()->id()) {
            abort(404);
        }

        $page->delete();

        toast('page was successfully deleted!', 'success');
        return back();
    }
}
