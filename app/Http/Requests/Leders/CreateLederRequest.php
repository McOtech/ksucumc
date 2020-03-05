<?php

namespace App\Http\Requests\Leders;

use Illuminate\Foundation\Http\FormRequest;

class CreateLederRequest extends FormRequest
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

            'name' => 'required|unique:leaders',
            'course' => 'required',
            'description' => 'required',
            'message' => 'required',
            // 'position_id' => 'required',
            'image' => 'required|image'
        ];
    }
}

