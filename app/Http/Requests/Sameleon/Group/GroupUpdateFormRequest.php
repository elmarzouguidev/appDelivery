<?php

namespace App\Http\Requests\Sameleon\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUpdateFormRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('groups')->ignore($this->route('group'), 'uuid')],
            'description' => ['nullable', 'string'],
            'admin' => ['required', 'integer'],
        ];
    }
}
