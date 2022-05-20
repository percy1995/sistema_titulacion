@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.docente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.docentes.update", [$docente->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="dni">{{ trans('cruds.docente.fields.dni') }}</label>
                <input class="form-control {{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni" id="dni" value="{{ old('dni', $docente->dni) }}" required>
                @if($errors->has('dni'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.dni_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="direccion">{{ trans('cruds.docente.fields.direccion') }}</label>
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" value="{{ old('direccion', $docente->direccion) }}" required>
                @if($errors->has('direccion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.direccion_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="correoinstitucional">{{ trans('cruds.docente.fields.correoinstitucional') }}</label>
                <input class="form-control {{ $errors->has('correoinstitucional') ? 'is-invalid' : '' }}" type="text" name="correoinstitucional" id="correoinstitucional" value="{{ old('correoinstitucional', $docente->correoinstitucional) }}" required>
                @if($errors->has('correoinstitucional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('correoinstitucional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.correoinstitucional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="correopersonal">{{ trans('cruds.docente.fields.correopersonal') }}</label>
                <input class="form-control {{ $errors->has('correopersonal') ? 'is-invalid' : '' }}" type="text" name="correopersonal" id="correopersonal" value="{{ old('correopersonal', $docente->correopersonal) }}">
                @if($errors->has('correopersonal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('correopersonal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.correopersonal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="celular">{{ trans('cruds.docente.fields.celular') }}</label>
                <input class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}" type="text" name="celular" id="celular" value="{{ old('celular', $docente->celular) }}">
                @if($errors->has('celular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('celular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.celular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.docente.fields.tipo') }}</label>
                <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo" required>
                    <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Docente::TIPO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tipo', $docente->tipo) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.tipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firma">{{ trans('cruds.docente.fields.firma') }}</label>
                <div class="needsclick dropzone {{ $errors->has('firma') ? 'is-invalid' : '' }}" id="firma-dropzone">
                </div>
                @if($errors->has('firma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('firma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.docente.fields.firma_helper') }}</span>
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