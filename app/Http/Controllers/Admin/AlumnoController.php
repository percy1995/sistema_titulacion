<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAlumnoRequest;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Models\Alumno;
use App\Models\Traplipro;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AlumnoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('alumno_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Alumno::with(['traplipro'])->select(sprintf('%s.*', (new Alumno())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'alumno_show';
                $editGate = 'alumno_edit';
                $deleteGate = 'alumno_delete';
                $crudRoutePart = 'alumnos';

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
            $table->editColumn('nombres', function ($row) {
                return $row->nombres ? $row->nombres : '';
            });
            $table->editColumn('apellidos', function ($row) {
                return $row->apellidos ? $row->apellidos : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->editColumn('dni', function ($row) {
                return $row->dni ? $row->dni : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $traplipros = Traplipro::get();

        return view('admin.alumnos.index', compact('traplipros'));
    }

    public function create()
    {
        abort_if(Gate::denies('alumno_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.alumnos.create');
    }

    public function store(StoreAlumnoRequest $request)
    {
        $alumno = Alumno::create($request->all());

        if ($request->input('firma', false)) {
            $alumno->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $alumno->id]);
        }

        return redirect()->route('admin.alumnos.index');
    }

    public function edit(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->load('traplipro');

        return view('admin.alumnos.edit', compact('alumno'));
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

        return redirect()->route('admin.alumnos.index');
    }

    public function show(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->load('traplipro');

        return view('admin.alumnos.show', compact('alumno'));
    }

    public function destroy(Alumno $alumno)
    {
        abort_if(Gate::denies('alumno_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alumno->delete();

        return back();
    }

    public function massDestroy(MassDestroyAlumnoRequest $request)
    {
        Alumno::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('alumno_create') && Gate::denies('alumno_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Alumno();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
