<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname'     => [
                'string',
                'required',
            ],
            'lastname'     => [
                'string',
                'required',
            ],
            'phone_number'     => [
                'string',
                'required',
            ],
            'address'     => [
                'string',
                'required',
            ],
            'country_id'     => [
                'string',
                'required',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
                'confirmed',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('system_user');
    }
}