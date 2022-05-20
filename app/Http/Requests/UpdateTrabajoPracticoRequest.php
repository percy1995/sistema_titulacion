<?php

namespace App\Http\Requests;

use App\Models\TrabajoPractico;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTrabajoPracticoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trabajo_practico_edit');
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
