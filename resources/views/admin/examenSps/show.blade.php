@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.examenSp.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.examen-sps.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.id') }}
                        </th>
                        <td>
                            {{ $examenSp->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.programaacademico') }}
                        </th>
                        <td>
                            {{ $examenSp->programaacademico->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.programamodular') }}
                        </th>
                        <td>
                            {{ $examenSp->programamodular->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.titulo') }}
                        </th>
                        <td>
                            {{ $examenSp->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.fecha') }}
                        </th>
                        <td>
                            {{ $examenSp->fecha }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.horainicio') }}
                        </th>
                        <td>
                            {{ $examenSp->horainicio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.horafin') }}
                        </th>
                        <td>
                            {{ $examenSp->horafin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.nota') }}
                        </th>
                        <td>
                            {{ $examenSp->nota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.archivo') }}
                        </th>
                        <td>
                            @foreach($examenSp->archivo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.examenSp.fields.docente') }}
                        </th>
                        <td>
                            {{ $examenSp->docente->dni ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.examen-sps.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection