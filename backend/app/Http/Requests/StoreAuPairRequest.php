<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuPairRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Auth logic can be added here
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'languages' => 'nullable|array',
            'bio' => 'nullable|string',
            'status' => 'nullable|in:pending,screening,approved,placed',
        ];
    }
}
