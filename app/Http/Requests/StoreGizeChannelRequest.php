<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreGizeChannelRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'producer' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'slug' => [
                'unique:gize_channels',
                'required',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('system_gize_channel');
    }
}
