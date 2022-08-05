<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Player;

class PlayerRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'slug' => 'required|unique:players,slug,' . $this->player_id . ',id',
            'nickname' => 'nullable|string',
            'shirt_number' => 'nullable|integer|min:0|max:99|unique:players,shirt_number,' . $this->player_id . ',id',
            'photo' => 'nullable|mimes:jpg,bmp,png',
            'about' => 'nullable|string',
            'sex' => 'nullable|integer|min:0|max:3',
            'birth_date' => 'nullable|date',
            'team_id' => 'nullable|integer',
            'user_id' => 'nullable|integer|unique:players,user_id,' . $this->player_id . ',id',
            'show_profile' => 'nullable|integer',
            'show_birth_date' => 'nullable|integer',
            'show_photo' => 'nullable|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Meno hráča je povinné.',
            'first_name.min' => 'Meno hráča musí obsahovať minimálne :min znakov.s',
            'first_name.max' => 'Meno hráča môže obsahovať maximálne :max znakov.',
            'last_name.required' => 'Priezvisko hráča je povinné.',
            'last_name.min' => 'Priezvisko hráča musí obsahovať minimálne :min znakov.',
            'last_name.max' => 'Priezvisko hráča môže obsahovať maximálne :max znakov.',
            'slug.unique' => 'Kombinácia mena a priezviska hráča sa už v databáze nachádza.',
            'nickname.string' => 'Prezývka musí byť text, nie číslo.',
            'shirt_number.integer' => 'Číslo dresu musí byť celé číslo.',
            'shirt_number.min' => 'Číslo dresu musí byť 0-99.',
            'shirt_number.max' => 'Číslo dresu musí byť 0-99.',
            'shirt_number.unique' => 'Číslo dresu sa už v databáze nachádza u iného hráča.',
            'photo.mimes' => 'Povolený formát fotky je: jpg,bmp,png.',
            'about.string' => 'O mne musí byť text, nie číslo.',
            'sex.integer' => 'Zlý formát podhlavia.',
            'sex.min' => 'Zlý formát podhlavia.',
            'sex.max' => 'Zlý formát podhlavia.',
            'birth_date.date' => 'Chybný formát dátumu narodenia.',
            'team_id.integer' => 'Zlý formát tímu.',
            'user_id.integer' => 'Zlý formát užívateľa.',
            'user_id.unique' => 'Tento užívateľ už má vytvorené hráčske konto.',
            'show_profile.integer' => 'Zlý formát show_profile.',
            'show_birth_date.integer' => 'Zlý formát show_birth_date.',
            'show_photo.integer' => 'Zlý formát show_photo.',
        ];
    }

    protected function prepareForValidation()
    {
        dd($this);
        $this->merge([
            'slug' => Str::slug($this->first_name . ' ' . $this->last_name),
            'user_id' => auth()->id()
        ]);
    }

}
