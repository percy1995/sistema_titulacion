<?php

namespace App\Http\Requests;

use App\Models\ExamenSp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExamenSpRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('examen_sp_edit');
    }

    public function rules()
    {
        return [
            'programaacademico_id' => [
                'required',
                'integer',
            ],
            'fecha' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'horainicio' => [
                'string',
                'nullable',
            ],
            'horafin' => [
                'string',
                'nullable',
            ],
            'nota' => [
                'string',
                'nullable',
            ],
            'archivo' => [
                'array',
            ],
        ];
    }
}
