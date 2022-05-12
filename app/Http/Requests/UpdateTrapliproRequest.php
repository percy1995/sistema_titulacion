<?php

namespace App\Http\Requests;

use App\Models\Traplipro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTrapliproRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('traplipro_edit');
    }

    public function rules()
    {
        return [
            'nota' => [
                'string',
                'nullable',
            ],
            'programaacademico_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
