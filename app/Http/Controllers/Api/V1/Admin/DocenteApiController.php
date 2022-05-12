<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Http\Resources\Admin\DocenteResource;
use App\Models\Docente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocenteApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('docente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocenteResource(Docente::with(['persona', 'programa'])->get());
    }

    public function store(StoreDocenteRequest $request)
    {
        $docente = Docente::create($request->all());

        if ($request->input('firma', false)) {
            $docente->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
        }

        return (new DocenteResource($docente))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Docente $docente)
    {
        abort_if(Gate::denies('docente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocenteResource($docente->load(['persona', 'programa']));
    }

    public function update(UpdateDocenteRequest $request, Docente $docente)
    {
        $docente->update($request->all());

        if ($request->input('firma', false)) {
            if (!$docente->firma || $request->input('firma') !== $docente->firma->file_name) {
                if ($docente->firma) {
                    $docente->firma->delete();
                }
                $docente->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
            }
        } elseif ($docente->firma) {
            $docente->firma->delete();
        }

        return (new DocenteResource($docente))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Docente $docente)
    {
        abort_if(Gate::denies('docente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docente->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
