<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExamenSpRequest;
use App\Http\Requests\StoreExamenSpRequest;
use App\Http\Requests\UpdateExamenSpRequest;
use App\Models\Docente;
use App\Models\ExamenSp;
use App\Models\Grupo;
use App\Models\ProgramaModular;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExamenSpController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('examen_sp_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ExamenSp::with(['programaacademico', 'programamodular', 'docente', 'grupo'])->select(sprintf('%s.*', (new ExamenSp())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'examen_sp_show';
                $editGate = 'examen_sp_edit';
                $deleteGate = 'examen_sp_delete';
                $crudRoutePart = 'examen-sps';

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

        return view('admin.examenSps.index', compact('programa_modulars', 'docentes', 'grupos'));
    }

    public function create()
    {
        abort_if(Gate::denies('examen_sp_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.examenSps.create', compact('docentes', 'programaacademicos', 'programamodulars'));
    }

    public function store(StoreExamenSpRequest $request)
    {
        $examenSp = ExamenSp::create($request->all());

        foreach ($request->input('archivo', []) as $file) {
            $examenSp->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $examenSp->id]);
        }

        return redirect()->route('admin.examen-sps.index');
    }

    public function edit(ExamenSp $examenSp)
    {
        abort_if(Gate::denies('examen_sp_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $examenSp->load('programaacademico', 'programamodular', 'docente', 'grupo');

        return view('admin.examenSps.edit', compact('docentes', 'examenSp', 'programaacademicos', 'programamodulars'));
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

        return redirect()->route('admin.examen-sps.index');
    }

    public function show(ExamenSp $examenSp)
    {
        abort_if(Gate::denies('examen_sp_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examenSp->load('programaacademico', 'programamodular', 'docente', 'grupo');

        return view('admin.examenSps.show', compact('examenSp'));
    }

    public function destroy(ExamenSp $examenSp)
    {
        abort_if(Gate::denies('examen_sp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examenSp->delete();

        return back();
    }

    public function massDestroy(MassDestroyExamenSpRequest $request)
    {
        ExamenSp::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('examen_sp_create') && Gate::denies('examen_sp_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ExamenSp();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
