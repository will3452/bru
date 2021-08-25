<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MarketingController extends Controller
{
    public function createMarketing()
    {
        return view('marketing.create');
    }

    public function index()
    {
        $markets = Cache::remember('list_of_marketing', 20, function () {
            return auth()->user()->markets;
        });

        return view('marketing.index', compact('markets'));
    }

    public function show($id)
    {

        $market = Cache::remember('show_of_market', 20, function () use ($id) {
            return auth()->user()->markets()->findOrFail($id);
        });

        return view('marketing.show', compact('market'));
    }

    public function store()
    {
        // return request()->all();
        $data = request()->validate([
            'duration' => 'required',
            'category' => 'required',
            'schedule' => 'required',
            'event_id' => '',
        ]);

        $market = auth()->user()->markets()->create($data);

        if ($data['category'] == 'bulletin') {

            $image = request()->image->store('/public/bul');
            $imageArr = explode('/', $image);
            $imageEnd = end($imageArr);
            $image = '/storage/bul/' . $imageEnd;

            // $image_post = request()->image_post->store('/public/bul');
            // $imageArr = explode('/', $image);
            // $imageEnd = end($imageArr);
            // $image_post = '/storage/bul/' . $imageEnd;

            $market->bulletin()->create([
                'name' => request()->name,
                'image' => $image,
                // 'image_post'=>$image_post,
                'content' => request()->bulletin_content,
            ]);

        }

        if ($data['category'] == 'marquee') {
            $market->announcement()->create([
                'content' => request()->content,
            ]);
        }

        if ($data['category'] == 'sliding_banner') {
            $image = request()->image->store('/public/ban');
            $imageArr = explode('/', $image);
            $imageEnd = end($imageArr);
            $image = '/storage/ban/' . $imageEnd;

            $market->banner()->create([
                'image' => $image,
            ]);
        }

        if ($data['category'] == 'in_app_message') {
            // return request()->all();
            $image = null;
            if (request()->has('image')) {
                $image = request()->image->store('/public/blast');
                $imageArr = explode('/', $image);
                $imageEnd = end($imageArr);
                $image = '/storage/blast/' . $imageEnd;
            }

            for ($i = 0; $i < count(request()->subject); $i++) {
                $market->message_blasts()->create([
                    'subject' => request()->subject[$i],
                    'message' => request()->message[$i],
                    'image' => $image,
                ]);
            }
        }

        if ($data['category'] == 'loading_image') {
            $image = request()->image->store('/public/li');
            $imageArr = explode('/', $image);
            $imageEnd = end($imageArr);
            $image = '/storage/li/' . $imageEnd;
            $market->preloader()->create([
                'image' => $image,
            ]);
        }

        if ($data['category'] == 'newspaper') {

            $image = request()->image->store('/public/newspaper');
            $imageArr = explode('/', $image);
            $imageEnd = end($imageArr);
            $image = '/storage/newspaper/' . $imageEnd;

            $newspaper = $market->newspaper()->create([
                'name' => request()->name,
            ]);

            $newspaper->pages()->create([
                'content' => $image,
                'text_content' => request()->newspaper_content,
            ]);

        }

        //save as draft
        if (request()->proceed_contract != 1) {
            toast('Saved as Draft', 'success');
            return redirect(route('home'));
        }

        return redirect(route('marketing.show', $market));
    }

    public function createPDF($id)
    {
        // retreive all records from db
        $market = auth()->user()->markets()->findOrFail($id);
        $data = [
            'category' => $market->category,
            'duration' => $market->day_duration . ' day(s)',
            'cost' => $market->cost,
            'schedule' => $market->schedule,
            'title' => 'Annex',
            'id' => $market->unique_id,
        ];
        $pdf = PDF::loadView('marketing.pdf', $data);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
