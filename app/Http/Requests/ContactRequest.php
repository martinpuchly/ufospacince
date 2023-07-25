<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContactRequest extends FormRequest
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
        return   [
            'email' => 'required|email',
            'text' => 'required|min:10',
        ];
    }



    public function messages():array
    {
        return   [
            'email.required' => 'Emailová adresa je povinný údaj.',
            'email.email' => 'Neplatný formát emailovej adresy.',
            'text.required' => 'Text správy je povinný údaj.',
            'text.min' => 'Text správy musí obsahovať minimálne :min znakov.',
        ];
    }
}
