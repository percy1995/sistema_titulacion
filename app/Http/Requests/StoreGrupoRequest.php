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
            'horainicio' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'horafin' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
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
