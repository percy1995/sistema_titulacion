<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMonitoreoRequest;
use App\Http\Requests\StoreMonitoreoRequest;
use App\Http\Requests\UpdateMonitoreoRequest;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Monitoreo;
use App\Models\Traplipro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MonitoreoController extends Controller
{
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
            $table->addColumn('grupo_nombre', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });

            $table->addColumn('docente_dni', function ($row) {
                return $row->docente ? $row->docente->dni : '';
            });

            $table->addColumn('traplipro_titulo', function ($row) {
                return $row->traplipro ? $row->traplipro->titulo : '';
            });

            $table->editColumn('horafin', function ($row) {
                return $row->horafin ? $row->horafin : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'grupo', 'docente', 'traplipro']);

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

        $grupos = Grupo::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $traplipros = Traplipro::pluck('titulo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.monitoreos.create', compact('docentes', 'grupos', 'traplipros'));
    }

    public function store(StoreMonitoreoRequest $request)
    {
        $monitoreo = Monitoreo::create($request->all());

        return redirect()->route('admin.monitoreos.index');
    }

    public function edit(Monitoreo $monitoreo)
    {
        abort_if(Gate::denies('monitoreo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grupos = Grupo::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $docentes = Docente::pluck('dni', 'id')->prepend(trans('global.pleaseSelect'), '');

        $traplipros = Traplipro::pluck('titulo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $monitoreo->load('grupo', 'docente', 'traplipro');

        return view('admin.monitoreos.edit', compact('docentes', 'grupos', 'monitoreo', 'traplipros'));
    }

    public function update(UpdateMonitoreoRequest $request, Monitoreo $monitoreo)
    {
        $monitoreo->update($request->all());

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
}
