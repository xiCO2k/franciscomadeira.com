<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishStripReleaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, list<string>> */
    public function rules(): array
    {
        return [
            'version' => ['required', 'regex:/^[0-9]+\.[0-9]+\.[0-9]+$/'],
            'build' => ['required', 'integer', 'min:1'],
            'archive' => ['required', 'file', 'max:524288'],
            'notes' => ['required', 'file', 'max:10240'],
            'appcast' => ['required', 'file', 'max:2048'],
        ];
    }
}
