<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgramaModularRequest;
use App\Http\Requests\UpdateProgramaModularRequest;
use App\Http\Resources\Admin\ProgramaModularResource;
use App\Models\ProgramaModular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramaModularApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('programa_modular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgramaModularResource(ProgramaModular::with(['programaacademico'])->get());
    }

    public function store(StoreProgramaModularRequest $request)
    {
        $programaModular = ProgramaModular::create($request->all());

        return (new ProgramaModularResource($programaModular))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProgramaModular $programaModular)
    {
        abort_if(Gate::denies('programa_modular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProgramaModularResource($programaModular->load(['programaacademico']));
    }

    public function update(UpdateProgramaModularRequest $request, ProgramaModular $programaModular)
    {
        $programaModular->update($request->all());

        return (new ProgramaModularResource($programaModular))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProgramaModular $programaModular)
    {
        abort_if(Gate::denies('programa_modular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaModular->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
