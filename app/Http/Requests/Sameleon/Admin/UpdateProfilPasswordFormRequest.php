<?php

namespace App\Http\Requests\Sameleon\Admin;

use App\Rules\Password\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilPasswordFormRequest extends FormRequest
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
            'hasPassword' => ['required', 'uuid'],
            'oldpassword' => ['nullable', 'string', 'min:6', new MatchOldPassword],
            'new_password' => ['required_with:oldpassword'],
            'new_confirm_password' => ['same:new_password'],
        ];
    }
}
