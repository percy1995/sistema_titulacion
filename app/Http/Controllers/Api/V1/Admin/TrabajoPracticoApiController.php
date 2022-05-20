<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTrabajoPracticoRequest;
use App\Http\Requests\UpdateTrabajoPracticoRequest;
use App\Http\Resources\Admin\TrabajoPracticoResource;
use App\Models\TrabajoPractico;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrabajoPracticoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('trabajo_practico_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrabajoPracticoResource(TrabajoPractico::with(['programaacademico', 'programamodular', 'docente', 'grupo'])->get());
    }

    public function store(StoreTrabajoPracticoRequest $request)
    {
        $trabajoPractico = TrabajoPractico::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $trabajoPractico->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        return (new TrabajoPracticoResource($trabajoPractico))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TrabajoPractico $trabajoPractico)
    {
        abort_if(Gate::denies('trabajo_practico_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrabajoPracticoResource($trabajoPractico->load(['programaacademico', 'programamodular', 'docente', 'grupo']));
    }

    public function update(UpdateTrabajoPracticoRequest $request, TrabajoPractico $trabajoPractico)
    {
        $trabajoPractico->update($request->all());

        if (count($trabajoPractico->archivo) > 0) {
            foreach ($trabajoPractico->archivo as $media) {
                if (!in_array($media->file_name, $request->input('archivo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $trabajoPractico->archivo->pluck('file_name')->toArray();
        foreach ($request->input('archivo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $trabajoPractico->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
            }
        }

        return (new TrabajoPracticoResource($trabajoPractico))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TrabajoPractico $trabajoPractico)
    {
        abort_if(Gate::denies('trabajo_practico_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trabajoPractico->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
