@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.periodo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.periodos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.periodo.fields.id') }}
                        </th>
                        <td>
                            {{ $periodo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.periodo.fields.periodo') }}
                        </th>
                        <td>
                            {{ $periodo->periodo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.periodo.fields.fechainicio') }}
                        </th>
                        <td>
                            {{ $periodo->fechainicio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.periodo.fields.fechafin') }}
                        </th>
                        <td>
                            {{ $periodo->fechafin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.periodo.fields.modo') }}
                        </th>
                        <td>
                            {{ $periodo->modo }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.periodos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection