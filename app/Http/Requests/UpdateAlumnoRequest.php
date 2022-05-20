<?php

namespace App\Http\Requests;

use App\Models\Alumno;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAlumnoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('alumno_edit');
    }

    public function rules()
    {
        return [
            'nombres' => [
                'string',
                'required',
            ],
            'apellidos' => [
                'string',
                'required',
            ],
            'correo' => [
                'string',
                'required',
            ],
            'dni' => [
                'string',
                'required',
            ],
        ];
    }
}
