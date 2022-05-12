<?php

namespace App\Http\Requests;

use App\Models\Docente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDocenteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('docente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:docentes,id',
        ];
    }
}
