<?php

namespace App\Http\Requests\Leders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLederRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'course' => 'required',
            'description' => 'required',
            'message' => 'required',
            'position' => 'required'
            // 'image' => 'required|image'
        ];
    }
}
