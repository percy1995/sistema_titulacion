<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPeriodoRequest;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Models\Periodo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PeriodoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('periodo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Periodo::query()->select(sprintf('%s.*', (new Periodo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'periodo_show';
                $editGate = 'periodo_edit';
                $deleteGate = 'periodo_delete';
                $crudRoutePart = 'periodos';

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
            $table->editColumn('periodo', function ($row) {
                return $row->periodo ? $row->periodo : '';
            });

            $table->editColumn('modo', function ($row) {
                return $row->modo ? $row->modo : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.periodos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('periodo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.periodos.create');
    }

    public function store(StorePeriodoRequest $request)
    {
        $periodo = Periodo::create($request->all());

        return redirect()->route('admin.periodos.index');
    }

    public function edit(Periodo $periodo)
    {
        abort_if(Gate::denies('periodo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.periodos.edit', compact('periodo'));
    }

    public function update(UpdatePeriodoRequest $request, Periodo $periodo)
    {
        $periodo->update($request->all());

        return redirect()->route('admin.periodos.index');
    }

    public function show(Periodo $periodo)
    {
        abort_if(Gate::denies('periodo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.periodos.show', compact('periodo'));
    }

    public function destroy(Periodo $periodo)
    {
        abort_if(Gate::denies('periodo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $periodo->delete();

        return back();
    }

    public function massDestroy(MassDestroyPeriodoRequest $request)
    {
        Periodo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
