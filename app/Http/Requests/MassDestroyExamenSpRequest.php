<?php

namespace App\Http\Requests;

use App\Models\ExamenSp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExamenSpRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('examen_sp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:examen_sps,id',
        ];
    }
}
