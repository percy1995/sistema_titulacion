<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPersonaRequest;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('persona_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Persona::query()->select(sprintf('%s.*', (new Persona())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'persona_show';
                $editGate = 'persona_edit';
                $deleteGate = 'persona_delete';
                $crudRoutePart = 'personas';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.personas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('persona_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personas.create');
    }

    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->all());

        return redirect()->route('admin.personas.index');
    }

    public function edit(Persona $persona)
    {
        abort_if(Gate::denies('persona_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personas.edit', compact('persona'));
    }

    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $persona->update($request->all());

        return redirect()->route('admin.personas.index');
    }

    public function show(Persona $persona)
    {
        abort_if(Gate::denies('persona_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personas.show', compact('persona'));
    }

    public function destroy(Persona $persona)
    {
        abort_if(Gate::denies('persona_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $persona->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonaRequest $request)
    {
        Persona::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
