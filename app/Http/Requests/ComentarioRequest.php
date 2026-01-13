<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->storeRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }

        return [];
    }

    private function storeRules(): array
    {
        return [
            'contenido' => 'required|string|max:1000',
        ];
    }

    private function updateRules(): array
    {
        return [
            'contenido' => 'required|string|max:1000',
        ];
    }
}
