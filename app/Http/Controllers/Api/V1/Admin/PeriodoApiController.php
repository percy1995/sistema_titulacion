<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Http\Resources\Admin\PeriodoResource;
use App\Models\Periodo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeriodoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('periodo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeriodoResource(Periodo::all());
    }

    public function store(StorePeriodoRequest $request)
    {
        $periodo = Periodo::create($request->all());

        return (new PeriodoResource($periodo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Periodo $periodo)
    {
        abort_if(Gate::denies('periodo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeriodoResource($periodo);
    }

    public function update(UpdatePeriodoRequest $request, Periodo $periodo)
    {
        $periodo->update($request->all());

        return (new PeriodoResource($periodo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Periodo $periodo)
    {
        abort_if(Gate::denies('periodo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periodo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
