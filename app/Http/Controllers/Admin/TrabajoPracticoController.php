<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrabajoPracticoRequest;
use App\Http\Requests\StoreTrabajoPracticoRequest;
use App\Http\Requests\UpdateTrabajoPracticoRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\ProgramaModular;
use App\Models\TrabajoPractico;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrabajoPracticoController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('trabajo_practico_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TrabajoPractico::with(['programaacademico', 'programamodular', 'docente', 'grupo'])->select(sprintf('%s.*', (new TrabajoPractico())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'trabajo_practico_show';
                $editGate = 'trabajo_practico_edit';
                $deleteGate = 'trabajo_practico_delete';
                $crudRoutePart = 'trabajo-practicos';

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
            $table->addColumn('programaacademico_nombreprograma', function ($row) {
                return $row->programaacademico ? $row->programaacademico->nombreprograma : '';
            });

            $table->addColumn('programamodular_nombreprograma', function ($row) {
                return $row->programamodular ? $row->programamodular->nombreprograma : '';
            });

            $table->editColumn('titulo', function ($row) {
                return $row->titulo ? $row->titulo : '';
            });

            $table->editColumn('horainicio', function ($row) {
                return $row->horainicio ? $row->horainicio : '';
            });
            $table->editColumn('horafin', function ($row) {
                return $row->horafin ? $row->horafin : '';
            });
            $table->editColumn('nota', function ($row) {
                return $row->nota ? $row->nota : '';
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
            $table->addColumn('docente_dni', function ($row) {
                return $row->docente ? $row->docente->dni : '';
            });

            $table->editColumn('docente.direccion', function ($row) {
                return $row->docente ? (is_string($row->docente) ? $row->docente : $row->docente->direccion) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'programaacademico', 'programamodular', 'archivo', 'docente']);

            return $table->make(true);
        }

        $programa_modulars = ProgramaModular::get();
        $docentes          = Docente::get();
        $grupos            = Grupo::get();

        return view('admin.trabajoPracticos.index', compact('programa_modulars', 'docentes', 'grupos'));
    }

    public function create()
    {
        abort_if(Gate::denies('trabajo_practico_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trabajoPracticos.create', compact('docentes', 'programaacademicos', 'programamodulars'));
    }

    public function store(StoreTrabajoPracticoRequest $request)
    {
        $trabajoPractico = TrabajoPractico::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $trabajoPractico->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trabajoPractico->id]);
        }

        return redirect()->route('admin.trabajo-practicos.index');
    }

    public function edit(TrabajoPractico $trabajoPractico)
    {
        abort_if(Gate::denies('trabajo_practico_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trabajoPractico->load('programaacademico', 'programamodular', 'docente', 'grupo');

        return view('admin.trabajoPracticos.edit', compact('docentes', 'programaacademicos', 'programamodulars', 'trabajoPractico'));
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

        return redirect()->route('admin.trabajo-practicos.index');
    }

    public function show(TrabajoPractico $trabajoPractico)
    {
        abort_if(Gate::denies('trabajo_practico_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trabajoPractico->load('programaacademico', 'programamodular', 'docente', 'grupo');

        return view('admin.trabajoPracticos.show', compact('trabajoPractico'));
    }

    public function destroy(TrabajoPractico $trabajoPractico)
    {
        abort_if(Gate::denies('trabajo_practico_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trabajoPractico->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrabajoPracticoRequest $request)
    {
        TrabajoPractico::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('trabajo_practico_create') && Gate::denies('trabajo_practico_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TrabajoPractico();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
