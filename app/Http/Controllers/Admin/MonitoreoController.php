<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMonitoreoRequest;
use App\Http\Requests\StoreMonitoreoRequest;
use App\Http\Requests\UpdateMonitoreoRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Monitoreo;
use App\Models\Traplipro;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MonitoreoController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('monitoreo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Monitoreo::with(['grupo', 'docente', 'traplipro'])->select(sprintf('%s.*', (new Monitoreo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'monitoreo_show';
                $editGate = 'monitoreo_edit';
                $deleteGate = 'monitoreo_delete';
                $crudRoutePart = 'monitoreos';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('horainicio', function ($row) {
                return $row->horainicio ? $row->horainicio : '';
            });
            $table->editColumn('horafin', function ($row) {
                return $row->horafin ? $row->horafin : '';
            });
            $table->editColumn('observacion', function ($row) {
                return $row->observacion ? $row->observacion : '';
            });
            $table->editColumn('archivo', function ($row) {
                if (!$row->archivo) {
                    return '';
                }
                $links = [];
                foreach ($row->archivo as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'archivo']);

            return $table->make(true);
        }

        $grupos     = Grupo::get();
        $docentes   = Docente::get();
        $traplipros = Traplipro::get();

        return view('admin.monitoreos.index', compact('grupos', 'docentes', 'traplipros'));
    }

    public function create()
    {
        abort_if(Gate::denies('monitoreo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.monitoreos.create');
    }

    public function store(StoreMonitoreoRequest $request)
    {
        $monitoreo = Monitoreo::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $monitoreo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $monitoreo->id]);
        }

        return redirect()->route('admin.monitoreos.index');
    }

    public function edit(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoreo->load('grupo', 'docente', 'traplipro');

        return view('admin.monitoreos.edit', compact('monitoreo'));
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

        return redirect()->route('admin.monitoreos.index');
    }

    public function show(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoreo->load('grupo', 'docente', 'traplipro');

        return view('admin.monitoreos.show', compact('monitoreo'));
    }

    public function destroy(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoreo->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonitoreoRequest $request)
    {
        Monitoreo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('monitoreo_create') && Gate::denies('monitoreo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Monitoreo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
