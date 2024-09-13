<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
        $rules = [
            't01nombre' => 'required',
            't01publicado' => 'required',
        ];

        if ($this->t01publicado) {
            $rules = array_merge($rules, [
                't01tituloseo' => 'required',
                't01metadescription' => 'required',
                't01slug' => 'required|unique:t01blogs'
            ]);
        }

        return $rules;
        // return [

        // ];
    }
}
