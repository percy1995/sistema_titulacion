<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramaRequest;
use App\Http\Requests\UpdateProgramaRequest;
use App\Http\Resources\Admin\ProgramaResource;
use App\Models\Programa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('programa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgramaResource(Programa::all());
    }

    public function store(StoreProgramaRequest $request)
    {
        $programa = Programa::create($request->all());

        return (new ProgramaResource($programa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Programa $programa)
    {
        abort_if(Gate::denies('programa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgramaResource($programa);
    }

    public function update(UpdateProgramaRequest $request, Programa $programa)
    {
        $programa->update($request->all());

        return (new ProgramaResource($programa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Programa $programa)
    {
        abort_if(Gate::denies('programa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
