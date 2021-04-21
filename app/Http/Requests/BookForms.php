<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BookForms extends FormRequest
{
    
    protected function prepareForValidation(){
        $path = $this->picture->store('public/book_cover');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $act_path = '/storage/book_cover/'.$end_path;
        $heat_level = null;
        $violence_level = null;
        $heat_age = null;
        $vio_age = null;
        if($this->heat){
            $heat_arr = explode('@', $this->heat);
            $heat_age = end($heat_arr);
            $heat_level = $heat_arr[0];
        }
        if($this->violence){
            $vio_arr = explode('@', $this->violence);
            $vio_age = end($vio_arr);
            $violence_level = $vio_arr[0];
        }
        $this->merge([
            'cover'=>$act_path,
            'slug'=>Str::slug($this->author.' '.$this->title),
            'violence_level'=>$violence_level,
            'heat_level'=>$heat_level,
            'age_restriction'=>$this->age_restriction ?? ($vio_age > $heat_age ? $heat_age : $vio_age)
            
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title'=>'required',
            'slug'=>'required',
            'class'=>'required',
            'category'=>'required',
            'author'=>'required',
            'genre'=>'required',
            'content_warning'=>'',
            'tag.*'=>'required',
            'language'=>'required',
            'cost'=>'',
            'lead_character'=>'required',
            'lead_college'=>'required',
            'review_question_1'=>'required',
            'review_question_2'=>'required',
            'credit_page'=>'required',
            'blurb'=>'required',
            'heat_level'=>'',
            'violence_level'=>'',
            'age_restriction'=>'',
            'cover'=>'required',
            'event_id'=>'',
            'free_art'=>'',
            'cpy'=>'',
            'group_id'=>''
        ];
    }
}
