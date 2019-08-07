<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'name'              => 'required|unique:clients,name',
            'description'       => 'nullable',
            'manager_id'        => 'nullable|exists:users,id',
            'client_id'         => 'required|exists:clients,id',
            'contact_name'      => 'nullable',
            'contact_phone'     => 'nullable',
            'contact_email'     => 'nullable|email',
        ];
    }
}
