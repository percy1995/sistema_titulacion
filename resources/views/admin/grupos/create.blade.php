@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.grupo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.grupos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">{{ trans('cruds.grupo.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                @if($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dia">{{ trans('cruds.grupo.fields.dia') }}</label>
                <input class="form-control {{ $errors->has('dia') ? 'is-invalid' : '' }}" type="text" name="dia" id="dia" value="{{ old('dia', '') }}" required>
                @if($errors->has('dia'))
                    <span class="text-danger">{{ $errors->first('dia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.dia_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="horainicio">{{ trans('cruds.grupo.fields.horainicio') }}</label>
                <input class="form-control timepicker {{ $errors->has('horainicio') ? 'is-invalid' : '' }}" type="text" name="horainicio" id="horainicio" value="{{ old('horainicio') }}" required>
                @if($errors->has('horainicio'))
                    <span class="text-danger">{{ $errors->first('horainicio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.horainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="horafin">{{ trans('cruds.grupo.fields.horafin') }}</label>
                <input class="form-control date {{ $errors->has('horafin') ? 'is-invalid' : '' }}" type="text" name="horafin" id="horafin" value="{{ old('horafin') }}" required>
                @if($errors->has('horafin'))
                    <span class="text-danger">{{ $errors->first('horafin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.horafin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tipo">{{ trans('cruds.grupo.fields.tipo') }}</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', '') }}" required>
                @if($errors->has('tipo'))
                    <span class="text-danger">{{ $errors->first('tipo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="aula">{{ trans('cruds.grupo.fields.aula') }}</label>
                <input class="form-control {{ $errors->has('aula') ? 'is-invalid' : '' }}" type="text" name="aula" id="aula" value="{{ old('aula', '') }}" required>
                @if($errors->has('aula'))
                    <span class="text-danger">{{ $errors->first('aula') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.aula_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="periodo_id">{{ trans('cruds.grupo.fields.periodo') }}</label>
                <select class="form-control select2 {{ $errors->has('periodo') ? 'is-invalid' : '' }}" name="periodo_id" id="periodo_id" required>
                    @foreach($periodos as $id => $entry)
                        <option value="{{ $id }}" {{ old('periodo_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('periodo'))
                    <span class="text-danger">{{ $errors->first('periodo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.periodo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docente_id">{{ trans('cruds.grupo.fields.docente') }}</label>
                <select class="form-control select2 {{ $errors->has('docente') ? 'is-invalid' : '' }}" name="docente_id" id="docente_id">
                    @foreach($docentes as $id => $entry)
                        <option value="{{ $id }}" {{ old('docente_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('docente'))
                    <span class="text-danger">{{ $errors->first('docente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.docente_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programaestudio_id">{{ trans('cruds.grupo.fields.programaestudio') }}</label>
                <select class="form-control select2 {{ $errors->has('programaestudio') ? 'is-invalid' : '' }}" name="programaestudio_id" id="programaestudio_id">
                    @foreach($programaestudios as $id => $entry)
                        <option value="{{ $id }}" {{ old('programaestudio_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programaestudio'))
                    <span class="text-danger">{{ $errors->first('programaestudio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.programaestudio_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection