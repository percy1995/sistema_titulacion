@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.monitoreo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.monitoreos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.id') }}
                        </th>
                        <td>
                            {{ $monitoreo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.fechaasesoria') }}
                        </th>
                        <td>
                            {{ $monitoreo->fechaasesoria }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.horainicio') }}
                        </th>
                        <td>
                            {{ $monitoreo->horainicio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.horafin') }}
                        </th>
                        <td>
                            {{ $monitoreo->horafin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.observacion') }}
                        </th>
                        <td>
                            {{ $monitoreo->observacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoreo.fields.archivo') }}
                        </th>
                        <td>
                            @foreach($monitoreo->archivo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.monitoreos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection