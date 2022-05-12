<?php

namespace App\Http\Requests;

use App\Models\Grupo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGrupoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grupo_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'dia' => [
                'string',
                'required',
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
                'string',
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
