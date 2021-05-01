<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreNovelFormRequest extends FormRequest
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

    protected function prepareForValidation(){
        $art = '';
        if($this->has('art_photo')){
            $path = $this->art_photo->store('public/arts');
            $arr_path = explode('/', $path);
            $end_path = end($arr_path);
            $art = '/storage/arts/'.$end_path;
        }
        $type = explode('_', $this->chapter_type);
        $this->merge([
            'content'=>$this->chapter_content,
            'type'=>$this->chapter_type,
            'art'=>$art,
            'slug'=>Str::slug($this->title.' '.uniqid()),
            'type'=>$type[0]
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
            'title'=>'',
            'content'=>'required',
            'type'=>'required',
            'art_cost'=>'',
            'art'=>'',
            'sq'=>'',
            'slug'=>'required',
            'cpy'=>'',
            'desc'=>'',
            'cost'=>'',
            'mode'=>'',
            'age_restriction'=>'',
            'foot_note'=>''
        ];
    }
}
