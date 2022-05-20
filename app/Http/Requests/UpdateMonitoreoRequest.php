<?php

namespace App\Http\Requests;

use App\Models\Monitoreo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMonitoreoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('monitoreo_edit');
    }

    public function rules()
    {
        return [
            'fechaasesoria' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'horainicio' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'horafin' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'observacion' => [
                'required',
            ],
            'archivo' => [
                'array',
                'required',
            ],
            'archivo.*' => [
                'required',
            ],
        ];
    }
}
