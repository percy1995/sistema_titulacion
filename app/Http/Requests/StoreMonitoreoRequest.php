<?php

namespace App\Http\Requests;

use App\Models\Monitoreo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMonitoreoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('monitoreo_create');
    }

    public function rules()
    {
        return [
            'fechaasesoria' => [
                'date_format:' . config('panel.date_format'),
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
        ];
    }
}
