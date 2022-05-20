@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.traplipro.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.traplipros.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="programaacademico_id">{{ trans('cruds.traplipro.fields.programaacademico') }}</label>
                <select class="form-control select2 {{ $errors->has('programaacademico') ? 'is-invalid' : '' }}" name="programaacademico_id" id="programaacademico_id" required>
                    @foreach($programaacademicos as $id => $entry)
                        <option value="{{ $id }}" {{ old('programaacademico_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programaacademico'))
                    <div class="invalid-feedback">
                        {{ $errors->first('programaacademico') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.programaacademico_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programamodular_id">{{ trans('cruds.traplipro.fields.programamodular') }}</label>
                <select class="form-control select2 {{ $errors->has('programamodular') ? 'is-invalid' : '' }}" name="programamodular_id" id="programamodular_id">
                    @foreach($programamodulars as $id => $entry)
                        <option value="{{ $id }}" {{ old('programamodular_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programamodular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('programamodular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.programamodular_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.traplipro.fields.titulo') }}</label>
                <textarea class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" name="titulo" id="titulo">{{ old('titulo') }}</textarea>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nota">{{ trans('cruds.traplipro.fields.nota') }}</label>
                <input class="form-control {{ $errors->has('nota') ? 'is-invalid' : '' }}" type="text" name="nota" id="nota" value="{{ old('nota', '') }}">
                @if($errors->has('nota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.nota_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docente_id">{{ trans('cruds.traplipro.fields.docente') }}</label>
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
                <span class="help-block">{{ trans('cruds.traplipro.fields.docente_helper') }}</span>
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