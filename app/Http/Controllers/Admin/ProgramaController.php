<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProgramaRequest;
use App\Http\Requests\StoreProgramaRequest;
use App\Http\Requests\UpdateProgramaRequest;
use App\Models\Programa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProgramaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('programa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Programa::query()->select(sprintf('%s.*', (new Programa())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'programa_show';
                $editGate = 'programa_edit';
                $deleteGate = 'programa_delete';
                $crudRoutePart = 'programas';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.programas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('programa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programas.create');
    }

    public function store(StoreProgramaRequest $request)
    {
        $programa = Programa::create($request->all());

        return redirect()->route('admin.programas.index');
    }

    public function edit(Programa $programa)
    {
        abort_if(Gate::denies('programa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programas.edit', compact('programa'));
    }

    public function update(UpdateProgramaRequest $request, Programa $programa)
    {
        $programa->update($request->all());

        return redirect()->route('admin.programas.index');
    }

    public function show(Programa $programa)
    {
        abort_if(Gate::denies('programa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programa->load('programaacademicoProgramaModulars');

        return view('admin.programas.show', compact('programa'));
    }

    public function destroy(Programa $programa)
    {
        abort_if(Gate::denies('programa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programa->delete();

        return back();
    }

    public function massDestroy(MassDestroyProgramaRequest $request)
    {
        Programa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
