<?php

namespace App\Http\Requests;

use App\Models\ProductType;
use App\Rules\RequiredAttributes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $productType = ProductType::find(request('productType'));
        
        return [
            'productType' => ['required', 'integer'],
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'required'],
            'condition' => ['required', Rule::in(['new', 'refurbished'])],
            'price' => ['numeric', 'required'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\Product'],
            'attributes' => ['required', 'JSON', new RequiredAttributes($productType->properties)],
            'mainCategory' => ['required', 'numeric']
        ];
    }
}
