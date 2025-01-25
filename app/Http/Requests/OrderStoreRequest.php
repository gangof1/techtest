<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends ApiFormRequest
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
        return [
            'name' => 'required|string|max:255|unique:orders,name',
            'description' => 'nullable|string|max:255',
            'products' => [
                'required',
                'array',
                function ($attribute, $arr, $fail) {
                    $uniqueIds = array_unique(array_column($arr, 'id'));
                    if (count($arr) !== count($uniqueIds)) {
                        $fail("Il campo {$attribute} contiene elementi duplicati.");
                    }
                },
            ],
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'date' => ['required', 'date', 'date_format:Y-m-d H:i:s']
        ];
    }
}
