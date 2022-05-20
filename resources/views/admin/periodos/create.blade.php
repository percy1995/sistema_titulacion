@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.periodo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.periodos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="periodo">{{ trans('cruds.periodo.fields.periodo') }}</label>
                <input class="form-control {{ $errors->has('periodo') ? 'is-invalid' : '' }}" type="text" name="periodo" id="periodo" value="{{ old('periodo', '') }}" required>
                @if($errors->has('periodo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('periodo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.periodo.fields.periodo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fechainicio">{{ trans('cruds.periodo.fields.fechainicio') }}</label>
                <input class="form-control date {{ $errors->has('fechainicio') ? 'is-invalid' : '' }}" type="text" name="fechainicio" id="fechainicio" value="{{ old('fechainicio') }}" required>
                @if($errors->has('fechainicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechainicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.periodo.fields.fechainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fechafin">{{ trans('cruds.periodo.fields.fechafin') }}</label>
                <input class="form-control date {{ $errors->has('fechafin') ? 'is-invalid' : '' }}" type="text" name="fechafin" id="fechafin" value="{{ old('fechafin') }}" required>
                @if($errors->has('fechafin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechafin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.periodo.fields.fechafin_helper') }}</span>
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