<?php

namespace App\Http\Requests;

use App\Models\Docente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDocenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('docente_edit');
    }

    public function rules()
    {
        return [
            'dni' => [
                'string',
                'min:8',
                'max:8',
                'required',
            ],
            'direccion' => [
                'string',
                'max:255',
                'required',
            ],
            'correoinstitucional' => [
                'string',
                'max:255',
                'nullable',
            ],
            'correopersonal' => [
                'string',
                'max:255',
                'nullable',
            ],
            'celular' => [
                'string',
                'max:255',
                'nullable',
            ],
            'tipo' => [
                'required',
            ],
        ];
    }
}
