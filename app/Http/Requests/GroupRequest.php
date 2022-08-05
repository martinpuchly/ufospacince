<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:groups,name,'.$this->id,
            'description' => 'nullable|min:3|max:500',
        ];
    }

    public function messages()
    {
        return   [
            'name.required' => 'Musíš vyplniť názov skupiny.',
            'name.unique' => 'Názov skupiny sa už v databáze nachádza.',
            'name.min' => 'Názov skupiny musí obsahovať :min znakov.',
            'name.max' => 'Názov skupiny môže obsahovať :max znakov.',
            'description.min' => 'Popis skupiny musí obsahovať :min znakov.',
            'description.max' => 'Popis skupiny môže obsahovať :max znakov.',
        ];
    }
}
