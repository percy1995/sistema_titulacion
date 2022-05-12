<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Http\Resources\Admin\AlumnoResource;
use App\Models\Alumno;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlumnoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('alumno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AlumnoResource(Alumno::with(['traplipro'])->get());
    }

    public function store(StoreAlumnoRequest $request)
    {
        $alumno = Alumno::create($request->all());

        if ($request->input('firma', false)) {
            $alumno->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
        }

        return (new AlumnoResource($alumno))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AlumnoResource($alumno->load(['traplipro']));
    }

    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        $alumno->update($request->all());

        if ($request->input('firma', false)) {
            if (!$alumno->firma || $request->input('firma') !== $alumno->firma->file_name) {
                if ($alumno->firma) {
                    $alumno->firma->delete();
                }
                $alumno->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
            }
        } elseif ($alumno->firma) {
            $alumno->firma->delete();
        }

        return (new AlumnoResource($alumno))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
