@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.docente.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.docentes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.id') }}
                        </th>
                        <td>
                            {{ $docente->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.dni') }}
                        </th>
                        <td>
                            {{ $docente->dni }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.direccion') }}
                        </th>
                        <td>
                            {{ $docente->direccion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.correoinstitucional') }}
                        </th>
                        <td>
                            {{ $docente->correoinstitucional }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.correopersonal') }}
                        </th>
                        <td>
                            {{ $docente->correopersonal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.celular') }}
                        </th>
                        <td>
                            {{ $docente->celular }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.tipo') }}
                        </th>
                        <td>
                            {{ $docente->tipo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.firma') }}
                        </th>
                        <td>
                            @if($docente->firma)
                                <a href="{{ $docente->firma->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $docente->firma->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.persona') }}
                        </th>
                        <td>
                            {{ $docente->persona->nombres ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.docente.fields.programa') }}
                        </th>
                        <td>
                            {{ $docente->programa->nombre ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.docentes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection