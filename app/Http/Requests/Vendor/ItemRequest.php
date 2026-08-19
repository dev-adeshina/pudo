<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vendor_location_id' => [
                'required',
                'integer',
                'exists:vendor_locations,id',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id',
            ],

            'logistics_profile_id' => [
                'required',
                'integer',
                'exists:logistics_profiles,id',
            ],

            'weight_class_id' => [
                'required',
                'integer',
                'exists:weight_classes,id',
            ],

            'size_class_id' => [
                'required',
                'integer',
                'exists:size_classes,id',
            ],

            'name' => [
                'required',
                'string',
                'max:191',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:220',
                'unique:items,slug',
            ],

            'description' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2',
            ],

            'currency' => [
                'sometimes',
                'string',
                'size:3',
                'uppercase',
            ],

            'stock_quantity' => [
                'required',
                'integer',
                'min:0',
            ],
        ];
    }
}



