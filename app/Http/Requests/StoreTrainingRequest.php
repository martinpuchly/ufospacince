<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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
            'dates'=>'required|array|min:1',
            'type'=>'required|integer',
            'place'=>'required|integer',
            'description'=>'nullable|min:3',
        ];
    }


    public function messages():array
    {
        return   [
            'dates.required' => 'Tréning musí obsahovať minimálne jeden termín.',
            'dates.array' => 'Tréning musí obsahovať minimálne jeden termín.',
            'dates.min' => 'Tréning musí obsahovať minimálne jeden termín.',
            'type.required' => 'Typ trénignu je povinný údaj.',
            'type.integer' => 'Typ trénignu je povinný údaj.',
            'place.required' => 'Miesto konania tréningu je povinný údaj.',
            'place.integer' => 'Miesto konania tréningu je povinný údaj.',          
            'description.min' => 'Doplňujúce informácie musia obsahovať minimálne :min znakov.',
        ];
    }


    protected function prepareForValidation(): void
    {
        $dates_date = [];
        foreach($this->dates as $d){
            $dates_date[] = date_create_from_format("d.m.Y H:i", $d);
        }

        $this->merge([
            'dates' => $dates_date,
        ]);
    }


}
