<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrapliproRequest;
use App\Http\Requests\UpdateTrapliproRequest;
use App\Http\Resources\Admin\TrapliproResource;
use App\Models\Traplipro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrapliproApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('traplipro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrapliproResource(Traplipro::with(['programaacademico', 'programamodular', 'docente', 'grupo'])->get());
    }

    public function store(StoreTrapliproRequest $request)
    {
        $traplipro = Traplipro::create($request->all());

        return (new TrapliproResource($traplipro))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Traplipro $traplipro)
    {
        abort_if(Gate::denies('traplipro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrapliproResource($traplipro->load(['programaacademico', 'programamodular', 'docente', 'grupo']));
    }

    public function update(UpdateTrapliproRequest $request, Traplipro $traplipro)
    {
        $traplipro->update($request->all());

        return (new TrapliproResource($traplipro))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Traplipro $traplipro)
    {
        abort_if(Gate::denies('traplipro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $traplipro->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
