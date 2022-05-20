<?php

namespace App\Http\Requests;

use App\Models\Grupo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGrupoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grupo_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'horainicio' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'horafin' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tipo' => [
                'required',
            ],
            'aula' => [
                'string',
                'required',
            ],
            'periodo_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
