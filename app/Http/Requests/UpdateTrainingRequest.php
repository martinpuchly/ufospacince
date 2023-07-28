<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingRequest extends FormRequest
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
            'date_time'=>'required|date',
            'type'=>'required|integer',
            'place'=>'required|integer',
            'description'=>'nullable|min:3',
        ];
    }


    public function messages():array
    {
        return   [
            'date_time.required' => 'Tréning musí obsahovať dátum a čas.',
            'date_time.date' => 'Tréning musí obsahovať dátum a čas.',
            'type.required' => 'Typ trénignu je povinný údaj.',
            'type.integer' => 'Typ trénignu je povinný údaj.',
            'place.required' => 'Miesto konania tréningu je povinný údaj.',
            'place.integer' => 'Miesto konania tréningu je povinný údaj.',          
            'description.min' => 'Doplňujúce informácie musia obsahovať minimálne :min znakov.',
        ];
    }
}
