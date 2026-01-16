<?php

namespace App\CRM\Properties\Request;

use Illuminate\Foundation\Http\FormRequest;

class AvailablePropertiesRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Se puede ajustar a políticas/permisos más adelante
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'page' => $this->input('page', 1),
            'per_page' => min((int) $this->input('per_page', 20), 50),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'property_type_id' => ['nullable', 'integer'],
            'office_id' => ['nullable', 'integer'],
            'zone_type' => ['nullable', 'string', 'in:neighborhood,district,municipality,region,location'],
            'zone_id' => ['nullable', 'integer'],
            'operation_type' => ['nullable', 'string', 'in:sale,rent'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'min_surface_m2' => ['nullable', 'integer', 'min:0'],
            'max_surface_m2' => ['nullable', 'integer', 'min:0'],
            'search' => ['nullable', 'string'],
            'page' => ['integer', 'min:1'],
            'per_page' => ['integer', 'min:1', 'max:50'],
        ];
    }
}
