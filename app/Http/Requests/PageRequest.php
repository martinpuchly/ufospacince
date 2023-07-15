<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
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
            'slug'=>'required|min:3|max:160|unique:pages,id,'.$this->id,
            'body'=>'required|min:10',
            'accessLevel'=>'nullable|integer|min:0|max:3',
            'description'=>'nullable',
            'user_id'=>'required'
        ];
    }



    public function messages(): array
    {
        return [
            'title.required'=>'Titulok stránky je povinný údaj.',
            'title.min'=>'Titulok stránky musí obsahovať minimálne :min znakov.',
            'title.max'=>'Titulok stránky môže obsajhovať maximálne :max znakov.',
            'slug.required'=>'URL stránky je povinný údaj.',
            'slug.min'=>'URL stránky musí obsahovať minimálne :min znakov.',
            'slug.max'=>'URL stránky môže obsajhovať maximálne :max znakov.',
            'slug.unique'=>'URL stránky sa už v databáze nachádza. Zvoľte iné.',
            'body.required'=>'Obsah stránky je povinný údaj.',
            'body.min'=>'Obsah stránky musí obsahovať minimálne :min znakov.',
            'accessLevel.integer'=>'Prístup k stránke musí byť celé číslo. Chyba stránky!',
            'accessLevel.min'=>'Prístup k stránke môže byť minimálne :min. Chyba stránky!',
            'accessLevel.max'=>'Prístup k stránke môže byť maximálne :max. Chyba stránky!',
            'user_id.required'=>'Neznámi autor úpravy. Chyba stránky!',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => empty(trim($this->slug)) ? Str::slug($this->title) : Str::slug($this->slug),
            'user_id' => $this->user()->id
        ]);
    }
}


