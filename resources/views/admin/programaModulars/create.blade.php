@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.programaModular.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.programa-modulars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nombreprograma">{{ trans('cruds.programaModular.fields.nombreprograma') }}</label>
                <input class="form-control {{ $errors->has('nombreprograma') ? 'is-invalid' : '' }}" type="text" name="nombreprograma" id="nombreprograma" value="{{ old('nombreprograma', '') }}" required>
                @if($errors->has('nombreprograma'))
                    <span class="text-danger">{{ $errors->first('nombreprograma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.programaModular.fields.nombreprograma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programaacademico_id">{{ trans('cruds.programaModular.fields.programaacademico') }}</label>
                <select class="form-control select2 {{ $errors->has('programaacademico') ? 'is-invalid' : '' }}" name="programaacademico_id" id="programaacademico_id">
                    @foreach($programaacademicos as $id => $entry)
                        <option value="{{ $id }}" {{ old('programaacademico_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programaacademico'))
                    <span class="text-danger">{{ $errors->first('programaacademico') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.programaModular.fields.programaacademico_helper') }}</span>
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