<?php

namespace App\Http\Requests;

use App\Models\Business;
use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'phone' => ['nullable','string', 'max:20'],
            'address' => ['nullable','string', 'max:255'],
            'employees' => ['nullable','numeric']
        ];
    }
}
