<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMonitoreoRequest;
use App\Http\Requests\UpdateMonitoreoRequest;
use App\Http\Resources\Admin\MonitoreoResource;
use App\Models\Monitoreo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonitoreoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('monitoreo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonitoreoResource(Monitoreo::with(['grupo', 'docente', 'traplipro'])->get());
    }

    public function store(StoreMonitoreoRequest $request)
    {
        $monitoreo = Monitoreo::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $monitoreo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        return (new MonitoreoResource($monitoreo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonitoreoResource($monitoreo->load(['grupo', 'docente', 'traplipro']));
    }

    public function update(UpdateMonitoreoRequest $request, Monitoreo $monitoreo)
    {
        $monitoreo->update($request->all());

        if (count($monitoreo->archivo) > 0) {
            foreach ($monitoreo->archivo as $media) {
                if (!in_array($media->file_name, $request->input('archivo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $monitoreo->archivo->pluck('file_name')->toArray();
        foreach ($request->input('archivo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $monitoreo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
            }
        }

        return (new MonitoreoResource($monitoreo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoreo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
