<?php

namespace App\Http\Requests;

use App\Models\Persona;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePersonaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('persona_create');
    }

    public function rules()
    {
        return [
            'nombres' => [
                'string',
                'max:255',
                'required',
            ],
            'apellidos' => [
                'string',
                'max:255',
                'required',
            ],
        ];
    }
}
