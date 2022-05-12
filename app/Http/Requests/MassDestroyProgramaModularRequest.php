<?php

namespace App\Http\Requests;

use App\Models\ProgramaModular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProgramaModularRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('programa_modular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:programa_modulars,id',
        ];
    }
}
