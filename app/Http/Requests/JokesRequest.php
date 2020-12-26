<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JokesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getQuantity(): int
    {
        return $this->input('quantity');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1|max:20',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'quantity' => $this->route('quantity'),
        ]);
    }
}
