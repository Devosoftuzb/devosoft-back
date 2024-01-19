<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name' => 'required',
            'position' => 'required',
            'telegram' => 'required',
            'instagram' => 'required',
            'linkidin' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp,heic,aae|max:2048',
        ];
    }
}
