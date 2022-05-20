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
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.grupo.fields.dia') }}</label>
                <select class="form-control {{ $errors->has('dia') ? 'is-invalid' : '' }}" name="dia" id="dia">
                    <option value disabled {{ old('dia', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Grupo::DIA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('dia', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('dia'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dia') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.dia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horainicio">{{ trans('cruds.grupo.fields.horainicio') }}</label>
                <input class="form-control timepicker {{ $errors->has('horainicio') ? 'is-invalid' : '' }}" type="text" name="horainicio" id="horainicio" value="{{ old('horainicio') }}">
                @if($errors->has('horainicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horainicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.horainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horafin">{{ trans('cruds.grupo.fields.horafin') }}</label>
                <input class="form-control timepicker {{ $errors->has('horafin') ? 'is-invalid' : '' }}" type="text" name="horafin" id="horafin" value="{{ old('horafin') }}">
                @if($errors->has('horafin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horafin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.horafin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.grupo.fields.tipo') }}</label>
                <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo" required>
                    <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Grupo::TIPO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="aula">{{ trans('cruds.grupo.fields.aula') }}</label>
                <input class="form-control {{ $errors->has('aula') ? 'is-invalid' : '' }}" type="text" name="aula" id="aula" value="{{ old('aula', '') }}" required>
                @if($errors->has('aula'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aula') }}
                    </div>
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
                    <div class="invalid-feedback">
                        {{ $errors->first('periodo') }}
                    </div>
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
                    <div class="invalid-feedback">
                        {{ $errors->first('docente') }}
                    </div>
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
                    <div class="invalid-feedback">
                        {{ $errors->first('programaestudio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.programaestudio_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.grupo.fields.tiposustentacion') }}</label>
                <select class="form-control {{ $errors->has('tiposustentacion') ? 'is-invalid' : '' }}" name="tiposustentacion" id="tiposustentacion">
                    <option value disabled {{ old('tiposustentacion', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Grupo::TIPOSUSTENTACION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tiposustentacion', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tiposustentacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tiposustentacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.tiposustentacion_helper') }}</span>
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