<?php

namespace App\Http\Controllers;

use App\DiaryImage;
use Illuminate\Http\Request;

class ApiDiaryImageController extends Controller
{
    public function postImage()
    {
        $diaryImage = DiaryImage::where('user_id', auth()->user()->id)->first();

        if (is_null($diaryImage)) {
            $diaryImage = DiaryImage::create(['user_id' => auth()->user()->id]);
        }


        if (request()->image1) {
            $diaryImage->image_1 = request()->image1;
        } elseif (request()->image2) {
            $diaryImage->image_2 = request()->image2;
        } elseif (request()->image3) {
            $diaryImage->image_3 = request()->image3;
        } elseif (request()->image4) {
            $diaryImage->image_4 = request()->image4;
        }
        $diaryImage->save();

        return response([
            'result'=>200
        ], 200);
    }

    public function getImage()
    {
        $diaryImage = DiaryImage::where('user_id', auth()->user()->id)->first();

        if (is_null($diaryImage)) {
            $diaryImage = DiaryImage::create(['user_id' => auth()->user()->id]);
        }

        return response([
            'images'=>$diaryImage
        ], 200);
    }
}
