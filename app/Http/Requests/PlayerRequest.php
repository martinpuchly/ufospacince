<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PlayerRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'nickname' => 'nullable|min:3|max:50',
            'shirt_number' => 'nullable|integer|min:0|max:99',
            'photo' => 'nullable|image',
            'about' => 'nullable|min:10|max:5000',
            'show_first_name' => 'nullable|boolean',
            'show_last_name' => 'nullable|boolean',
            'show_nickname' => 'nullable|boolean',
            'show_birst_date' => 'nullable|boolean',
            'show_shirt_number' => 'nullable|boolean',
            'show_photo' => 'nullable|boolean',
            'show_about' => 'nullable|boolean',
            'show_user' => 'nullable|boolean',
            'user_id' => 'nullable|unique:players,user_id,'.$this->user_id, 
            'slug' => 'required|unique:players,slug,'.$this->id, 

        ];
    }

    public function messages():array
    {
        return   [
            'first_name.required' => 'Meno hráča je povinný údaj.',
            'first_name.min' => 'Meno hráča musí obsahovať :min znakov.',
            'first_name.max' => 'Meno hráča môže obsahovať :max znakov.',

            'last_name.required' => 'Priezvisko hráča je povinný údaj.',
            'last_name.min' => 'Priezvisko hráča musí obsahovať :min znakov.',
            'last_name.max' => 'Priezvisko hráča môže obsahovať :max znakov.',

        ];
    }


    protected function prepareForValidation(): void
{
    $this->merge([
        'slug' => Str::slug($this->first_name.' '.$this->nickname.' '.$this->last_name),
    ]);
}
}
