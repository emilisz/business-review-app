<?php

namespace App\Http\Requests;

use App\Domain\Repositories\BusinessRepository;
use App\Models\Business;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('business-update', $this->business);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required']
        ];
    }
}
