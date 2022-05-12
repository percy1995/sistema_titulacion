<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTrapliproRequest;
use App\Http\Requests\StoreTrapliproRequest;
use App\Http\Requests\UpdateTrapliproRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\ProgramaModular;
use App\Models\Traplipro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrapliproController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('traplipro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Traplipro::with(['programaacademico', 'programamodular', 'grupo', 'docente'])->select(sprintf('%s.*', (new Traplipro())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'traplipro_show';
                $editGate = 'traplipro_edit';
                $deleteGate = 'traplipro_delete';
                $crudRoutePart = 'traplipros';

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
            $table->editColumn('titulo', function ($row) {
                return $row->titulo ? $row->titulo : '';
            });
            $table->editColumn('nota', function ($row) {
                return $row->nota ? $row->nota : '';
            });
            $table->addColumn('programaacademico_nombreprograma', function ($row) {
                return $row->programaacademico ? $row->programaacademico->nombreprograma : '';
            });

            $table->addColumn('programamodular_nombreprograma', function ($row) {
                return $row->programamodular ? $row->programamodular->nombreprograma : '';
            });

            $table->addColumn('grupo_nombre', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });

            $table->addColumn('docente_dni', function ($row) {
                return $row->docente ? $row->docente->dni : '';
            });

            $table->editColumn('docente.direccion', function ($row) {
                return $row->docente ? (is_string($row->docente) ? $row->docente : $row->docente->direccion) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'programaacademico', 'programamodular', 'grupo', 'docente']);

            return $table->make(true);
        }

        $programa_modulars = ProgramaModular::get();
        $grupos            = Grupo::get();
        $docentes          = Docente::get();

        return view('admin.traplipros.index', compact('programa_modulars', 'grupos', 'docentes'));
    }

    public function create()
    {
        abort_if(Gate::denies('traplipro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grupos = Grupo::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.traplipros.create', compact('docentes', 'grupos', 'programaacademicos', 'programamodulars'));
    }

    public function store(StoreTrapliproRequest $request)
    {
        $traplipro = Traplipro::create($request->all());

        return redirect()->route('admin.traplipros.index');
    }

    public function edit(Traplipro $traplipro)
    {
        abort_if(Gate::denies('traplipro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programamodulars = ProgramaModular::pluck('nombreprograma', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grupos = Grupo::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $traplipro->load('programaacademico', 'programamodular', 'grupo', 'docente');

        return view('admin.traplipros.edit', compact('docentes', 'grupos', 'programaacademicos', 'programamodulars', 'traplipro'));
    }

    public function update(UpdateTrapliproRequest $request, Traplipro $traplipro)
    {
        $traplipro->update($request->all());

        return redirect()->route('admin.traplipros.index');
    }

    public function show(Traplipro $traplipro)
    {
        abort_if(Gate::denies('traplipro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $traplipro->load('programaacademico', 'programamodular', 'grupo', 'docente');

        return view('admin.traplipros.show', compact('traplipro'));
    }

    public function destroy(Traplipro $traplipro)
    {
        abort_if(Gate::denies('traplipro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $traplipro->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrapliproRequest $request)
    {
        Traplipro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
