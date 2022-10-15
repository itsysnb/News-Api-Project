<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if ($this->getMethod() == 'POST')
            return $this->createRules();
        if ($this->getMethod() == 'PUT' || $this->getMethod() == "PATCH")
            return $this->updateRules();
    }

    public function createRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
            'category' => ['required', 'exists:categories,id']
        ];
    }

    public function updateRules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required'],
            'user_id' => ['sometimes', 'required', 'exists:users,id'],
            'category' => ['sometimes', 'required', 'exists:categories,id']
        ];
    }
}
