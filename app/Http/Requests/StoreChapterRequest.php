<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreChapterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $art = '';
        if ($this->has('art_photo')) {
            $path = $this->art_photo->store('public/arts');
            $arr_path = explode('/', $path);
            $end_path = end($arr_path);
            $art = '/storage/arts/' . $end_path;
        }
        $chapter_path = $this->chapter_content->store('public/chapter_content');
        $chapter_arrpath = explode('/', $chapter_path);
        $chapter_endpath = end($chapter_arrpath);
        $type = explode('_', $this->chapter_type);
        $chapter = '/storage/chapter_content/' . $chapter_endpath;
        $this->merge([
            'content' => $chapter,
            'type' => $this->chapter_type,
            'art' => $art,
            'slug' => Str::slug($this->title . ' ' . uniqid()),
            'type' => $type[0],
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => '',
            'slug' => 'required',
            'art' => '',
            'art_cost' => '',
            'sq' => '',
            'type' => 'required',
            'content' => 'required',
            'desc' => '',
            'cpy' => '',
            'cost' => '',
            'mode' => '',
            'age_restriction' => '',
            'foot_note' => '',
        ];
    }
}
