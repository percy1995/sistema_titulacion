@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.traplipro.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.traplipros.update", [$traplipro->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.traplipro.fields.titulo') }}</label>
                <textarea class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" name="titulo" id="titulo">{{ old('titulo', $traplipro->titulo) }}</textarea>
                @if($errors->has('titulo'))
                    <span class="text-danger">{{ $errors->first('titulo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nota">{{ trans('cruds.traplipro.fields.nota') }}</label>
                <input class="form-control {{ $errors->has('nota') ? 'is-invalid' : '' }}" type="text" name="nota" id="nota" value="{{ old('nota', $traplipro->nota) }}">
                @if($errors->has('nota'))
                    <span class="text-danger">{{ $errors->first('nota') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.nota_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="programaacademico_id">{{ trans('cruds.traplipro.fields.programaacademico') }}</label>
                <select class="form-control select2 {{ $errors->has('programaacademico') ? 'is-invalid' : '' }}" name="programaacademico_id" id="programaacademico_id" required>
                    @foreach($programaacademicos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('programaacademico_id') ? old('programaacademico_id') : $traplipro->programaacademico->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programaacademico'))
                    <span class="text-danger">{{ $errors->first('programaacademico') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.programaacademico_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programamodular_id">{{ trans('cruds.traplipro.fields.programamodular') }}</label>
                <select class="form-control select2 {{ $errors->has('programamodular') ? 'is-invalid' : '' }}" name="programamodular_id" id="programamodular_id">
                    @foreach($programamodulars as $id => $entry)
                        <option value="{{ $id }}" {{ (old('programamodular_id') ? old('programamodular_id') : $traplipro->programamodular->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programamodular'))
                    <span class="text-danger">{{ $errors->first('programamodular') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.programamodular_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="grupo_id">{{ trans('cruds.traplipro.fields.grupo') }}</label>
                <select class="form-control select2 {{ $errors->has('grupo') ? 'is-invalid' : '' }}" name="grupo_id" id="grupo_id">
                    @foreach($grupos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('grupo_id') ? old('grupo_id') : $traplipro->grupo->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('grupo'))
                    <span class="text-danger">{{ $errors->first('grupo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.traplipro.fields.grupo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docente_id">{{ trans('cruds.traplipro.fields.docente') }}</label>
                <select class="form-control select2 {{ $errors->has('docente') ? 'is-invalid' : '' }}" name="docente_id" id="docente_id">
                    @foreach($docentes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('docente_id') ? old('docente_id') : $traplipro->docente->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('docente'))
                    <span class="text-danger">{{ $errors->first('docente') }}</span>
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