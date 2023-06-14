<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Slide;

class SlideRequest extends FormRequest
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
            'title' => 'required|min:3|max:25',
            'description' => 'nullable|min:3|max:150',
            'link' => 'nullable|url',
            'image.name' => 'required|image|mimes:jpeg,jpg,png,gif,svg',
            'position' => 'required|integer|min:0|max:200',
            'active' => 'required|boolean',
        ];
    }



    public function messages():array
    {
        return   [
            'title.required' => 'Titulok slidu je povinný.',
            'title.min' => 'Titulok slidu musí obsahovať :min znakov.',
            'title.max' => 'Titulok slidu môže obsahovať :max znakov.',
            'description.min' => 'Podtitulok slidu musí obsahovať :min znakov.',
            'description.max' => 'PPodtitulok slidu môže obsahovať :max znakov.',
            'link.url' => 'Neplatný formát URL adresy.',
            'image.required' => 'Obrázok slidu je povinný.',
            'image.image' => 'Neplatný formát obrázku slidu.',
            'position.required' => 'Pozícia je povinný údaj.',
            'position.integer' => 'Pozícia musí byť celé číslo od :min do :max znakov.',
            'position.min' => 'Pozícia musí byť celé číslo od :min do :max znakov.',
            'position.max' => 'Pozícia musí byť celé číslo od :min do :max znakov.',
            'active.boolean' => 'Chyba.',
        ];
    }



    protected function prepareForValidation(): void
    {
        $this->merge([
            'active' => $this->active ? 1 : 0,
            'position' => $this->position ? $this->position : Slide::max('position')+1,
        ]);
    }
}
