<?php

namespace App\Http\Requests\Sameleon\Source;

use Illuminate\Foundation\Http\FormRequest;

class SourceFormRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'unique:sources'],
            'domain' => ['required', 'string', 'unique:sources'],
            'integration' => ['required', 'uuid'],
        ];
    }
}
