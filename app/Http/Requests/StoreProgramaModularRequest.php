<?php

namespace App\Http\Requests;

use App\Models\ProgramaModular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProgramaModularRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('programa_modular_create');
    }

    public function rules()
    {
        return [
            'nombreprograma' => [
                'string',
                'required',
            ],
        ];
    }
}
