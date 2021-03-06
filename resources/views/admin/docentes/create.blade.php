@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.docente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.docentes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="dni">{{ trans('cruds.docente.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni" id="dni" value="{{ old('dni', '00000000') }}" required>
                @if($errors->has('dni'))
                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.dni_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="direccion">{{ trans('cruds.docente.fields.direccion') }}</label>
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" value="{{ old('direccion', '') }}" required>
                @if($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.direccion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="correoinstitucional">{{ trans('cruds.docente.fields.correoinstitucional') }}</label>
                <input class="form-control {{ $errors->has('correoinstitucional') ? 'is-invalid' : '' }}" type="text" name="correoinstitucional" id="correoinstitucional" value="{{ old('correoinstitucional', '') }}">
                @if($errors->has('correoinstitucional'))
                    <span class="text-danger">{{ $errors->first('correoinstitucional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.correoinstitucional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="correopersonal">{{ trans('cruds.docente.fields.correopersonal') }}</label>
                <input class="form-control {{ $errors->has('correopersonal') ? 'is-invalid' : '' }}" type="text" name="correopersonal" id="correopersonal" value="{{ old('correopersonal', '') }}">
                @if($errors->has('correopersonal'))
                    <span class="text-danger">{{ $errors->first('correopersonal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.correopersonal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="celular">{{ trans('cruds.docente.fields.celular') }}</label>
                <input class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}" type="text" name="celular" id="celular" value="{{ old('celular', '') }}">
                @if($errors->has('celular'))
                    <span class="text-danger">{{ $errors->first('celular') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.celular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tipo">{{ trans('cruds.docente.fields.tipo') }}</label>
                <input class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" type="text" name="tipo" id="tipo" value="{{ old('tipo', '') }}" required>
                @if($errors->has('tipo'))
                    <span class="text-danger">{{ $errors->first('tipo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firma">{{ trans('cruds.docente.fields.firma') }}</label>
                <div class="needsclick dropzone {{ $errors->has('firma') ? 'is-invalid' : '' }}" id="firma-dropzone">
                </div>
                @if($errors->has('firma'))
                    <span class="text-danger">{{ $errors->first('firma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.firma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="persona_id">{{ trans('cruds.docente.fields.persona') }}</label>
                <select class="form-control select2 {{ $errors->has('persona') ? 'is-invalid' : '' }}" name="persona_id" id="persona_id">
                    @foreach($personas as $id => $entry)
                        <option value="{{ $id }}" {{ old('persona_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('persona'))
                    <span class="text-danger">{{ $errors->first('persona') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.persona_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programa_id">{{ trans('cruds.docente.fields.programa') }}</label>
                <select class="form-control select2 {{ $errors->has('programa') ? 'is-invalid' : '' }}" name="programa_id" id="programa_id">
                    @foreach($programas as $id => $entry)
                        <option value="{{ $id }}" {{ old('programa_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('programa'))
                    <span class="text-danger">{{ $errors->first('programa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.programa_helper') }}</span>
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
    url: '{{ route('admin.docentes.storeMedia') }}',
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
@if(isset($docente) && $docente->firma)
      var file = {!! json_encode($docente->firma) !!}
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