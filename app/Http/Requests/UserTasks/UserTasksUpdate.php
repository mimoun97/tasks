<?php

namespace App\Http\Requests\UserTasks;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserTasksUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('user.tasks.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
