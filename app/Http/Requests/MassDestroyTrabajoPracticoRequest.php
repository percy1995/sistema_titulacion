<?php

namespace App\Http\Requests;

use App\Models\TrabajoPractico;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTrabajoPracticoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('trabajo_practico_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trabajo_practicos,id',
        ];
    }
}
