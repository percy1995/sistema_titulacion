<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocenteRequest;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Models\Docente;
use App\Models\Persona;
use App\Models\Programa;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DocenteController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('docente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Docente::with(['persona', 'programa'])->select(sprintf('%s.*', (new Docente())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'docente_show';
                $editGate = 'docente_edit';
                $deleteGate = 'docente_delete';
                $crudRoutePart = 'docentes';

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
            $table->editColumn('dni', function ($row) {
                return $row->dni ? $row->dni : '';
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : '';
            });
            $table->editColumn('correoinstitucional', function ($row) {
                return $row->correoinstitucional ? $row->correoinstitucional : '';
            });
            $table->editColumn('correopersonal', function ($row) {
                return $row->correopersonal ? $row->correopersonal : '';
            });
            $table->editColumn('celular', function ($row) {
                return $row->celular ? $row->celular : '';
            });
            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : '';
            });
            $table->editColumn('firma', function ($row) {
                if ($photo = $row->firma) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'firma']);

            return $table->make(true);
        }

        $personas  = Persona::get();
        $programas = Programa::get();

        return view('admin.docentes.index', compact('personas', 'programas'));
    }

    public function create()
    {
        abort_if(Gate::denies('docente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personas = Persona::pluck('nombres', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programas = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.docentes.create', compact('personas', 'programas'));
    }

    public function store(StoreDocenteRequest $request)
    {
        $docente = Docente::create($request->all());

        if ($request->input('firma', false)) {
            $docente->addMedia(storage_path('tmp/uploads/' . basename($request->input('firma'))))->toMediaCollection('firma');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $docente->id]);
        }

        return redirect()->route('admin.docentes.index');
    }

    public function edit(Docente $docente)
    {
        abort_if(Gate::denies('docente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personas = Persona::pluck('nombres', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programas = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docente->load('persona', 'programa');

        return view('admin.docentes.edit', compact('docente', 'personas', 'programas'));
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

        return redirect()->route('admin.docentes.index');
    }

    public function show(Docente $docente)
    {
        abort_if(Gate::denies('docente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docente->load('persona', 'programa');

        return view('admin.docentes.show', compact('docente'));
    }

    public function destroy(Docente $docente)
    {
        abort_if(Gate::denies('docente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $docente->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocenteRequest $request)
    {
        Docente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('docente_create') && Gate::denies('docente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Docente();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
