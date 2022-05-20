@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.alumno.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.alumnos.update", [$alumno->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombres">{{ trans('cruds.alumno.fields.nombres') }}</label>
                <input class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}" type="text" name="nombres" id="nombres" value="{{ old('nombres', $alumno->nombres) }}" required>
                @if($errors->has('nombres'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombres') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.nombres_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="apellidos">{{ trans('cruds.alumno.fields.apellidos') }}</label>
                <input class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}" required>
                @if($errors->has('apellidos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.apellidos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="correo">{{ trans('cruds.alumno.fields.correo') }}</label>
                <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="text" name="correo" id="correo" value="{{ old('correo', $alumno->correo) }}" required>
                @if($errors->has('correo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('correo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.correo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dni">{{ trans('cruds.alumno.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni" id="dni" value="{{ old('dni', $alumno->dni) }}" required>
                @if($errors->has('dni'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.dni_helper') }}</span>
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