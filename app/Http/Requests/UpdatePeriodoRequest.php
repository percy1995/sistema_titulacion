<?php

namespace App\Http\Requests;

use App\Models\Periodo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePeriodoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('periodo_edit');
    }

    public function rules()
    {
        return [
            'periodo' => [
                'string',
                'required',
            ],
            'fechainicio' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'fechafin' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'modo' => [
                'string',
                'required',
            ],
        ];
    }
}
