@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trabajoPractico.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trabajo-practicos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.id') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.programaacademico') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->programaacademico->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.programamodular') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->programamodular->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.titulo') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.fecha') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->fecha }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.horainicio') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->horainicio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.horafin') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->horafin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.nota') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->nota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.archivo') }}
                        </th>
                        <td>
                            @foreach($trabajoPractico->archivo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trabajoPractico.fields.docente') }}
                        </th>
                        <td>
                            {{ $trabajoPractico->docente->dni ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trabajo-practicos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection