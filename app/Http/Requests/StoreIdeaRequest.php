<?php

namespace App\Http\Requests;

use App\Enums\IdeaStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                Rule::in(IdeaStatus::values()),
            ],
            'image' => [
                'nullable',
                'image',
                'max:5120',
            ],
            'steps' => [
                'nullable',
                'array',
            ],
            'steps.*' => [
                'array',
            ],
            'steps.*.description' => [
                'required',
                'string',
                'max:255',
            ],
            'steps.*.completed' => [
                'required',
                'boolean',
            ],
            'links' => [
                'nullable',
                'array',
            ],
            'links.*' => [
                'required',
                'url',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
            'image.image' => 'El archivo seleccionado debe ser una imagen.',
            'image.max' => 'La imagen no puede superar los 5 MB.',
            'steps.*.description.required' => 'La descripción del paso es obligatoria.',
            'steps.*.description.max' => 'La descripción del paso no puede superar los 255 caracteres.',
            'steps.*.completed.required' => 'El estado del paso es obligatorio.',
            'steps.*.completed.boolean' => 'El estado del paso debe ser verdadero o falso.',
            'links.*.url' => 'Cada enlace debe ser una URL válida.',
        ];
    }
}
