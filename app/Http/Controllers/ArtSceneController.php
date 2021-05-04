<?php

namespace App\Http\Controllers;

use App\Art;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ArtForm;
use Illuminate\Support\Facades\Hash;

class ArtSceneController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function create(){
        return view('arts.create');
    }

    public function list(){
        $arts = auth()->user()->arts;

        return view('arts.list', compact('arts'));
    }

    public function show(Art $art){
        return view('arts.show', compact('art'));
    }

    public function store(ArtForm $request){
        $validated = $request->validated();
        $validated['cpy'] = now();
        $validated['description'] = $validated['desc'];
        unset($validated['desc']);
        $rtag =request()->tag;
        unset($validated['tag']);
        $file = $validated['file']->store('public/arts');
        $file_arr = explode('/', $file);
        $file_end = end($file_arr);
        $file = '/storage/arts/'.$file_end;

        $validated['file'] = $file;

        $art = auth()->user()->arts()->create($validated);

        //attaching tags
        if(request()->has('tag')){
            $tag_len = count($request->tag) < 10 ? count($request->tag) : 10;
            for($i = 0; $i < $tag_len; $i++){
                $tags = Tag::where('name', $rtag[$i])->get();
                if(!count($tags)){
                    $tag = Tag::create(['name'=>$rtag[$i]]);
                    $tag->arts()->attach($art->id);
                }else {
                    $tags[0]->arts()->attach($art->id);
                }
            }
        }

        return redirect(route('arts.list').'?id='.$art->id);

    }

    public function update(Art $art){
        $validated = request()->validate([
            'desc'=>'',
            'artist'=>'',
            'credits'=>'',
            'genre'=>'',
            'lead_college'=>'',
        ]);

        $validated['description'] = $validated['desc'];
        unset($validated['desc']);

        $art->update($validated);
        return back()->withSuccess('Done!');
    }

    public function destroy(Art $art){
        if(!Hash::check(request()->password, auth()->user()->password)){
            return abort(401);
        }

        $art->delete();
        return redirect()->route('arts.list')->withSuccess('Done');
    }
}
