@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.traplipro.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.traplipros.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.id') }}
                        </th>
                        <td>
                            {{ $traplipro->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.programaacademico') }}
                        </th>
                        <td>
                            {{ $traplipro->programaacademico->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.programamodular') }}
                        </th>
                        <td>
                            {{ $traplipro->programamodular->nombreprograma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.titulo') }}
                        </th>
                        <td>
                            {{ $traplipro->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.nota') }}
                        </th>
                        <td>
                            {{ $traplipro->nota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.traplipro.fields.docente') }}
                        </th>
                        <td>
                            {{ $traplipro->docente->dni ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.traplipros.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection