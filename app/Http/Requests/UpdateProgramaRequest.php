<?php

namespace App\Http\Requests;

use App\Models\Programa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProgramaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('programa_edit');
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
