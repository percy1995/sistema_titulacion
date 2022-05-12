<?php

namespace App\Http\Requests;

use App\Models\Programa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProgramaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('programa_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'required',
            ],
        ];
    }
}
