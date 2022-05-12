@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.monitoreo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.monitoreos.update", [$monitoreo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="grupo_id">{{ trans('cruds.monitoreo.fields.grupo') }}</label>
                <select class="form-control select2 {{ $errors->has('grupo') ? 'is-invalid' : '' }}" name="grupo_id" id="grupo_id">
                    @foreach($grupos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('grupo_id') ? old('grupo_id') : $monitoreo->grupo->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('grupo'))
                    <span class="text-danger">{{ $errors->first('grupo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.grupo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docente_id">{{ trans('cruds.monitoreo.fields.docente') }}</label>
                <select class="form-control select2 {{ $errors->has('docente') ? 'is-invalid' : '' }}" name="docente_id" id="docente_id">
                    @foreach($docentes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('docente_id') ? old('docente_id') : $monitoreo->docente->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('docente'))
                    <span class="text-danger">{{ $errors->first('docente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.docente_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="traplipro_id">{{ trans('cruds.monitoreo.fields.traplipro') }}</label>
                <select class="form-control select2 {{ $errors->has('traplipro') ? 'is-invalid' : '' }}" name="traplipro_id" id="traplipro_id">
                    @foreach($traplipros as $id => $entry)
                        <option value="{{ $id }}" {{ (old('traplipro_id') ? old('traplipro_id') : $monitoreo->traplipro->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('traplipro'))
                    <span class="text-danger">{{ $errors->first('traplipro') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.traplipro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fechaasesoria">{{ trans('cruds.monitoreo.fields.fechaasesoria') }}</label>
                <input class="form-control date {{ $errors->has('fechaasesoria') ? 'is-invalid' : '' }}" type="text" name="fechaasesoria" id="fechaasesoria" value="{{ old('fechaasesoria', $monitoreo->fechaasesoria) }}">
                @if($errors->has('fechaasesoria'))
                    <span class="text-danger">{{ $errors->first('fechaasesoria') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.fechaasesoria_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horainicio">{{ trans('cruds.monitoreo.fields.horainicio') }}</label>
                <input class="form-control timepicker {{ $errors->has('horainicio') ? 'is-invalid' : '' }}" type="text" name="horainicio" id="horainicio" value="{{ old('horainicio', $monitoreo->horainicio) }}">
                @if($errors->has('horainicio'))
                    <span class="text-danger">{{ $errors->first('horainicio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.horainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horafin">{{ trans('cruds.monitoreo.fields.horafin') }}</label>
                <input class="form-control timepicker {{ $errors->has('horafin') ? 'is-invalid' : '' }}" type="text" name="horafin" id="horafin" value="{{ old('horafin', $monitoreo->horafin) }}">
                @if($errors->has('horafin'))
                    <span class="text-danger">{{ $errors->first('horafin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.horafin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observacion">{{ trans('cruds.monitoreo.fields.observacion') }}</label>
                <textarea class="form-control {{ $errors->has('observacion') ? 'is-invalid' : '' }}" name="observacion" id="observacion">{{ old('observacion', $monitoreo->observacion) }}</textarea>
                @if($errors->has('observacion'))
                    <span class="text-danger">{{ $errors->first('observacion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.observacion_helper') }}</span>
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