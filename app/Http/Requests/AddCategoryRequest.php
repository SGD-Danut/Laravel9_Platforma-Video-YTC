<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'title' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Categoria nu poate fi adăugată fără un nume!',
            'title.max' => 'Numele categoriei nu poate să aibă mai mult de 50 de caractere!'
        ];
    }
}
