<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TaskStore extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'deadline' => 'required',
            'start' => 'required',
            'user_id' => 'required',
            'project' => 'required',
            'priority' => 'required',
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
