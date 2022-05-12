<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProgramaModularRequest;
use App\Http\Requests\StoreProgramaModularRequest;
use App\Http\Requests\UpdateProgramaModularRequest;
use App\Models\Programa;
use App\Models\ProgramaModular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProgramaModularController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('programa_modular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProgramaModular::with(['programaacademico'])->select(sprintf('%s.*', (new ProgramaModular())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'programa_modular_show';
                $editGate = 'programa_modular_edit';
                $deleteGate = 'programa_modular_delete';
                $crudRoutePart = 'programa-modulars';

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
            $table->editColumn('nombreprograma', function ($row) {
                return $row->nombreprograma ? $row->nombreprograma : '';
            });
            $table->addColumn('programaacademico_nombre', function ($row) {
                return $row->programaacademico ? $row->programaacademico->nombre : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'programaacademico']);

            return $table->make(true);
        }

        $programas = Programa::get();

        return view('admin.programaModulars.index', compact('programas'));
    }

    public function create()
    {
        abort_if(Gate::denies('programa_modular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.programaModulars.create', compact('programaacademicos'));
    }

    public function store(StoreProgramaModularRequest $request)
    {
        $programaModular = ProgramaModular::create($request->all());

        return redirect()->route('admin.programa-modulars.index');
    }

    public function edit(ProgramaModular $programaModular)
    {
        abort_if(Gate::denies('programa_modular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaacademicos = Programa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $programaModular->load('programaacademico');

        return view('admin.programaModulars.edit', compact('programaModular', 'programaacademicos'));
    }

    public function update(UpdateProgramaModularRequest $request, ProgramaModular $programaModular)
    {
        $programaModular->update($request->all());

        return redirect()->route('admin.programa-modulars.index');
    }

    public function show(ProgramaModular $programaModular)
    {
        abort_if(Gate::denies('programa_modular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaModular->load('programaacademico');

        return view('admin.programaModulars.show', compact('programaModular'));
    }

    public function destroy(ProgramaModular $programaModular)
    {
        abort_if(Gate::denies('programa_modular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programaModular->delete();

        return back();
    }

    public function massDestroy(MassDestroyProgramaModularRequest $request)
    {
        ProgramaModular::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
