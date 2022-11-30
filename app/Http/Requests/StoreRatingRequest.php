<?php

namespace App\Http\Requests;

use App\Models\Business;
use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rating' => 'required|integer|between:1,5',
            'comment' => '',
//            'business_id' => 'required|unique:business,name' . $this->route('business')->id,
        ];
    }
}
