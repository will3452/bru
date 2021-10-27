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


        if (request()->selectedimage == 'image1') {
            $diaryImage->image_1 = request()->imagepath;
        } elseif (request()->selectedimage == 'image2') {
            $diaryImage->image_2 = request()->imagepath;
        } elseif (request()->selectedimage == 'image3') {
            $diaryImage->image_3 = request()->imagepath;
        } elseif (request()->selectedimage == 'image4') {
            $diaryImage->image_4 = request()->imagepath;
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
