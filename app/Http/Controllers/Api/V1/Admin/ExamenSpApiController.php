<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExamenSpRequest;
use App\Http\Requests\UpdateExamenSpRequest;
use App\Http\Resources\Admin\ExamenSpResource;
use App\Models\ExamenSp;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamenSpApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('examen_sp_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamenSpResource(ExamenSp::with(['programaacademico', 'programamodular', 'docente', 'grupo'])->get());
    }

    public function store(StoreExamenSpRequest $request)
    {
        $examenSp = ExamenSp::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $examenSp->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        return (new ExamenSpResource($examenSp))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExamenSp $examenSp)
    {
        abort_if(Gate::denies('examen_sp_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamenSpResource($examenSp->load(['programaacademico', 'programamodular', 'docente', 'grupo']));
    }

    public function update(UpdateExamenSpRequest $request, ExamenSp $examenSp)
    {
        $examenSp->update($request->all());

        if (count($examenSp->archivo) > 0) {
            foreach ($examenSp->archivo as $media) {
                if (!in_array($media->file_name, $request->input('archivo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $examenSp->archivo->pluck('file_name')->toArray();
        foreach ($request->input('archivo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $examenSp->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
            }
        }

        return (new ExamenSpResource($examenSp))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExamenSp $examenSp)
    {
        abort_if(Gate::denies('examen_sp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examenSp->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
