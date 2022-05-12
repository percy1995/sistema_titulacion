<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Http\Resources\Admin\PersonaResource;
use App\Models\Persona;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('persona_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonaResource(Persona::all());
    }

    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->all());

        return (new PersonaResource($persona))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Persona $persona)
    {
        abort_if(Gate::denies('persona_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PersonaResource($persona);
    }

    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $persona->update($request->all());

        return (new PersonaResource($persona))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Persona $persona)
    {
        abort_if(Gate::denies('persona_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $persona->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
