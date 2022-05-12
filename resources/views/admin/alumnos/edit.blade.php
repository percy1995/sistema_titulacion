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
                <label for="traplipro_id">{{ trans('cruds.alumno.fields.traplipro') }}</label>
                <select class="form-control select2 {{ $errors->has('traplipro') ? 'is-invalid' : '' }}" name="traplipro_id" id="traplipro_id">
                    @foreach($traplipros as $id => $entry)
                        <option value="{{ $id }}" {{ (old('traplipro_id') ? old('traplipro_id') : $alumno->traplipro->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('traplipro'))
                    <span class="text-danger">{{ $errors->first('traplipro') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.traplipro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nombres">{{ trans('cruds.alumno.fields.nombres') }}</label>
                <input class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}" type="text" name="nombres" id="nombres" value="{{ old('nombres', $alumno->nombres) }}">
                @if($errors->has('nombres'))
                    <span class="text-danger">{{ $errors->first('nombres') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.nombres_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="apellidos">{{ trans('cruds.alumno.fields.apellidos') }}</label>
                <input class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}">
                @if($errors->has('apellidos'))
                    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.apellidos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="correo">{{ trans('cruds.alumno.fields.correo') }}</label>
                <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="text" name="correo" id="correo" value="{{ old('correo', $alumno->correo) }}" required>
                @if($errors->has('correo'))
                    <span class="text-danger">{{ $errors->first('correo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.correo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dni">{{ trans('cruds.alumno.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni" id="dni" value="{{ old('dni', $alumno->dni) }}">
                @if($errors->has('dni'))
                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.dni_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firma">{{ trans('cruds.alumno.fields.firma') }}</label>
                <div class="needsclick dropzone {{ $errors->has('firma') ? 'is-invalid' : '' }}" id="firma-dropzone">
                </div>
                @if($errors->has('firma'))
                    <span class="text-danger">{{ $errors->first('firma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.alumno.fields.firma_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.firmaDropzone = {
    url: '{{ route('admin.alumnos.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="firma"]').remove()
      $('form').append('<input type="hidden" name="firma" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="firma"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($alumno) && $alumno->firma)
      var file = {!! json_encode($alumno->firma) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="firma" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection