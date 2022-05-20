<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGrupoRequest;
use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Periodo;
use App\Models\Programa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GrupoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('grupo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Grupo::with(['periodo', 'docente', 'programaestudio'])->select(sprintf('%s.*', (new Grupo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'grupo_show';
                $editGate = 'grupo_edit';
                $deleteGate = 'grupo_delete';
                $crudRoutePart = 'grupos';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('dia', function ($row) {
                return $row->dia ? Grupo::DIA_SELECT[$row->dia] : '';
            });
            $table->editColumn('horainicio', function ($row) {
                return $row->horainicio ? $row->horainicio : '';
            });
            $table->editColumn('horafin', function ($row) {
                return $row->horafin ? $row->horafin : '';
            });
            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? Grupo::TIPO_SELECT[$row->tipo] : '';
            });
            $table->editColumn('aula', function ($row) {
                return $row->aula ? $row->aula : '';
            });
            $table->addColumn('periodo_periodo', function ($row) {
                return $row->periodo ? $row->periodo->periodo : '';
            });

            $table->addColumn('programaestudio_nombre', function ($row) {
                return $row->programaestudio ? $row->programaestudio->nombre : '';
            });

            $table->editColumn('tiposustentacion', function ($row) {
                return $row->tiposustentacion ? Grupo::TIPOSUSTENTACION_SELECT[$row->tiposustentacion] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'periodo', 'programaestudio']);

            return $table->make(true);
        }

        $periodos  = Periodo::get();
        $docentes  = Docente::get();
        $programas = Programa::get();

        return view('admin.grupos.index', compact('periodos', 'docentes', 'programas'));
    }

    public function create()
    {
        abort_if(Gate::denies('grupo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periodos = Periodo::pluck('periodo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programaestudios = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.grupos.create', compact('docentes', 'periodos', 'programaestudios'));
    }

    public function store(StoreGrupoRequest $request)
    {
        $grupo = Grupo::create($request->all());

        return redirect()->route('admin.grupos.index');
    }

    public function edit(Grupo $grupo)
    {
        abort_if(Gate::denies('grupo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periodos = Periodo::pluck('periodo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programaestudios = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grupo->load('periodo', 'docente', 'programaestudio');

        return view('admin.grupos.edit', compact('docentes', 'grupo', 'periodos', 'programaestudios'));
    }

    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        $grupo->update($request->all());

        return redirect()->route('admin.grupos.index');
    }

    public function show(Grupo $grupo)
    {
        abort_if(Gate::denies('grupo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupo->load('periodo', 'docente', 'programaestudio');

        return view('admin.grupos.show', compact('grupo'));
    }

    public function destroy(Grupo $grupo)
    {
        abort_if(Gate::denies('grupo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupo->delete();

        return back();
    }

    public function massDestroy(MassDestroyGrupoRequest $request)
    {
        Grupo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
