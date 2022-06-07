<?php

namespace App\Http\Requests\Hooks\ClickFunnels;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class HookRequest extends FormRequest
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
       // Log::warning('From Validator');
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ];
    }
}
