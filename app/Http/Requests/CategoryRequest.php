<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    public function rules()
    {
        if ($this->getMethod() == 'POST')
            return $this->createRules();
        if ($this->getMethod() == 'PUT' || $this->getMethod() == 'PATCH')
            return $this->updateRules();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['required'],
            'parent_id' => ['sometimes', 'nullable', 'exists:categories,id']
        ];
    }

    public function updateRules()
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['sometimes', 'required'],
            'parent_id' => ['sometimes', 'nullable', 'exists:categories,id']
        ];
    }
}
