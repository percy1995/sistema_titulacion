@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.persona.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.personas.update", [$persona->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombres">{{ trans('cruds.persona.fields.nombres') }}</label>
                <input class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}" type="text" name="nombres" id="nombres" value="{{ old('nombres', $persona->nombres) }}" required>
                @if($errors->has('nombres'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombres') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.persona.fields.nombres_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="apellidos">{{ trans('cruds.persona.fields.apellidos') }}</label>
                <input class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $persona->apellidos) }}" required>
                @if($errors->has('apellidos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.persona.fields.apellidos_helper') }}</span>
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