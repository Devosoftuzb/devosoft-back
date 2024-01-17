<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvantageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_uz' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,SVG,WebP,HEIC,AAE|max:2048',
        ];
    }
}
