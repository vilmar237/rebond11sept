<?php

namespace App\Http\Requests\Admin\Employee;

use App\Http\Requests\CoreRequest;

class UpdateRequest extends CoreRequest
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
        $setting = global_setting();
        $rules = [
            'email' => 'required|max:100|unique:users,email,'.$this->route('user'),
            'first_name'  => 'required|max:50',
            'last_name'  => 'required|max:50',
            'role' => 'required',
            'joining_date' => 'required',
            'date_of_birth' => 'nullable|date_format:"' . $setting->date_format . '"|before_or_equal:'.now($setting->timezone)->toDateString(),
        ];

        $rules['slack_username'] = 'nullable|unique:users,slack_username';

        if (request()->password != '') {
            $rules['password'] = 'required|min:8|max:50';
        }

        return $rules;
    }
}