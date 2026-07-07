<?php

namespace Ecommerce\Http\Requests\Discount;

use Ecommerce\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;

class DiscountStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $names=implode(',',DiscountType::getValues());
        return [
            'title' => 'required|string',
            'type' => "required|in:{$names}",
            'value' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer',
            'conditions' => 'nullable|json',
        ];
    }
}
