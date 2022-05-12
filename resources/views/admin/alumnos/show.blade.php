@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.alumno.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alumnos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.id') }}
                        </th>
                        <td>
                            {{ $alumno->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.traplipro') }}
                        </th>
                        <td>
                            {{ $alumno->traplipro->titulo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.nombres') }}
                        </th>
                        <td>
                            {{ $alumno->nombres }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.apellidos') }}
                        </th>
                        <td>
                            {{ $alumno->apellidos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.correo') }}
                        </th>
                        <td>
                            {{ $alumno->correo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.dni') }}
                        </th>
                        <td>
                            {{ $alumno->dni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.alumno.fields.firma') }}
                        </th>
                        <td>
                            @if($alumno->firma)
                                <a href="{{ $alumno->firma->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $alumno->firma->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alumnos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection