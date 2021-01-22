<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'posts' || $this->is('posts/*')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:15',
            'study_time' => 'required|integer|min:1|max:1439',
            'text' => 'required|string|max:250',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '科目名',
            'study_time' => '勉強時間',
            'text' => '詳細',
        ];
    }

    public function messages()
    {
        return [
            'study_time.min' => ':attributeは、1分以上になるように指定してください。',
            'study_time.max' => ':attributeは、23時間59分以下になるように指定してください。',
        ];
    }
}
