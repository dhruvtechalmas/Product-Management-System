<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',

            'sku' => 'required|string|max:255|unique:products,sku',

            'category_id' => 'required|exists:categories,id',

            'price' => 'required|numeric|min:0',

            'quantity' => 'required|integer|min:0',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // 'status' => 'required|in:0,1',

            'stock' => 'required|integer|min:0',

            'stock_status' => 'required|in:in_stock,out_of_stock',
        ];
    }


    
    //   Custom Messages
     
    public function messages(): array
    {
        return [

            'name.required' => 'Product name is required',

            'sku.required' => 'SKU is required',

            'sku.unique' => 'SKU already exists',

            'price.required' => 'Price is required',

            'image.image' => 'Only image files allowed',
        ];
    }
}
