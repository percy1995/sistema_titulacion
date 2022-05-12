<?php

namespace App\Http\Requests;

use App\Models\Alumno;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('alumno_create');
    }

    public function rules()
    {
        return [
            'nombres' => [
                'string',
                'nullable',
            ],
            'apellidos' => [
                'string',
                'nullable',
            ],
            'correo' => [
                'string',
                'required',
            ],
            'dni' => [
                'string',
                'nullable',
            ],
        ];
    }
}
