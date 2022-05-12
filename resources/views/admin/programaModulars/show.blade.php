@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.programaModular.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.programa-modulars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.programaModular.fields.id') }}
                        </th>
                        <td>
                            {{ $programaModular->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.programaModular.fields.nombreprograma') }}
                        </th>
                        <td>
                            {{ $programaModular->nombreprograma }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.programaModular.fields.programaacademico') }}
                        </th>
                        <td>
                            {{ $programaModular->programaacademico->nombre ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.programa-modulars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection