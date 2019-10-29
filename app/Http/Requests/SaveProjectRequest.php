<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return $this->user()->can('update', $this->route('project'));
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:255',
                Rule::unique('projects')->ignore($this->route('project'))
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('The title cannot be empty'),
            'title.unique' => __('A project with this title already exists')
        ];
    }
}
