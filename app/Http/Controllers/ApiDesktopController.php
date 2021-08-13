<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Book;
use App\Podcast;
use App\Song;
use App\Thrailer;

class ApiDesktopController extends Controller
{
    public function getOverview()
    {
        $data = request()->validate([
            'type' => '',
        ]);
        if (!isset($data['type'])) {
            $data['type'] = 'default';
        }

        $listenings = collect();
        $reads = auth()->user()->subscriptions(Book::class)->latest()->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'author' => $item->author ?? $item->artist,
            ];
        });

        $listening1 = auth()->user()->subscriptions(Audio::class)->latest()->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'author' => $item->author ?? $item->artist,
            ];
        });

        $listening2 = auth()->user()->subscriptions(Podcast::class)->latest()->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'author' => $item->host,
            ];
        });

        $listening3 = auth()->user()->subscriptions(Song::class)->latest()->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'author' => $item->author ?? $item->artist,
            ];
        });

        $watching = auth()->user()->subscriptions(Thrailer::class)->latest()->get()->map(function ($item) {
            return [
                'title' => $item->title,
                'author' => $item->author ?? $item->artist,
            ];
        });

        $shelfs = $reads->push($listening1->flatMap(function ($item) {
            return $item;
        }));

        $listenings->push($listening1)->push($listening2)->push($listening3);
        $listenings = $listenings->flatMap(function ($value) {
            return $value;
        });

        $finished = [
            [
                'title' => 'sample title',
                'author' => 'author 1',
            ],
            [
                'title' => 'sample title 2',
                'author' => 'author 2',
            ],
        ];
        $return = $shelfs;
        if ($data['type'] == 'listening') {
            $return = $listenings;
        } else if ($data['type'] == 'watching') {
            $return = $watching;
        } else if ($data['type'] == 'reading') {
            $return = $reads;
        } else if ($data['type'] == 'finish') {
            $return = $finished;
        }

        return response([
            'items' => $return,
            'result' => 200,
        ], 200);

    }
}
