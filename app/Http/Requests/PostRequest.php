<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:3|max:150',
            'slug'=>'required|min:3|max:160|unique:posts,id,'.$this->id,
            'intro'=>'required|min:50',
            'body'=>'nullable|min:10',
            'tags'=>'nullable',
            'published'=>'nullable|boolean',
            'published_at'=>'required|date',
            'keywords'=>'nullable',
            'description'=>'nullable',
            'user_id'=>'required'
        ];
    }



    public function messages(): array
    {
        return [
            'title.required'=>'Titulok článku je povinný údaj.',
            'title.min'=>'Titulok článku musí obsahovať minimálne :min znakov.',
            'title.max'=>'Titulok článku môže obsajhovať maximálne :max znakov.',
            'intro.required'=>'Úvod článku je povinný údaj.',
            'intro.min'=>'Úvod článku musí obsahovať minimálne :min znakov.',            
            'body.min'=>'Text článku musí obsahovať minimálne :min znakov.',
            'published_at.date'=>'Dátum publikovania má nesprávny formát.',
            'user_id.required'=>'Neznámi autor úpravy. Chyba stránky!',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title.' '.Date("m-Y")),
            'user_id' => $this->user()->id,
            'intro' => trim($this->intro),
            'body' => trim($this->body),
            'published' => $this->published ? true : false, 
            'published_at' => empty($this->published_at) ? Date("Y-m-d H:i") : $this->published_at,
            'tags' => $this->tags ? implode(',' ,array_map(function($a) { return Str::slug($a); }, explode(',', $this->tags))) : ''
        ]);
    }




}
