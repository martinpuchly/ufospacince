<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Slide;

class SlideUpdateRequest extends FormRequest
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
            'picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
            'active' => 'required|boolean',
        ];
    }



    public function messages(): array
    {
        return   [
            'title.required' => 'Titulok slidu je povinný.',
            'title.min' => 'Titulok slidu musí obsahovať :min znakov.',
            'title.max' => 'Titulok slidu môže obsahovať :max znakov.',
            'description.min' => 'Podtitulok slidu musí obsahovať :min znakov.',
            'description.max' => 'Podtitulok slidu môže obsahovať :max znakov.',
            'link.url' => 'Neplatný formát URL adresy.',
            'picture.image' => 'Neplatný formát obrázku slidu.',
            'picture.mimes' => 'Neplatný formát obrázku slidu. Povolené sú formáty: jpeg, jpg, png, gif, svg.',
            'active.boolean' => 'Chyba.',
        ];
    }



    protected function prepareForValidation(): void
    {
        $this->merge([
            'active' => $this->active ? 1 : 0,
        ]);
    }
}
