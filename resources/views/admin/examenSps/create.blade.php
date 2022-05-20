@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.examenSp.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.examen-sps.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="programaacademico_id">{{ trans('cruds.examenSp.fields.programaacademico') }}</label>
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
                <span class="help-block">{{ trans('cruds.examenSp.fields.programaacademico_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="programamodular_id">{{ trans('cruds.examenSp.fields.programamodular') }}</label>
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
                <span class="help-block">{{ trans('cruds.examenSp.fields.programamodular_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.examenSp.fields.titulo') }}</label>
                <textarea class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" name="titulo" id="titulo">{{ old('titulo') }}</textarea>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fecha">{{ trans('cruds.examenSp.fields.fecha') }}</label>
                <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
                @if($errors->has('fecha'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.fecha_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horainicio">{{ trans('cruds.examenSp.fields.horainicio') }}</label>
                <input class="form-control {{ $errors->has('horainicio') ? 'is-invalid' : '' }}" type="text" name="horainicio" id="horainicio" value="{{ old('horainicio', '') }}">
                @if($errors->has('horainicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horainicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.horainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horafin">{{ trans('cruds.examenSp.fields.horafin') }}</label>
                <input class="form-control {{ $errors->has('horafin') ? 'is-invalid' : '' }}" type="text" name="horafin" id="horafin" value="{{ old('horafin', '') }}">
                @if($errors->has('horafin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horafin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.horafin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nota">{{ trans('cruds.examenSp.fields.nota') }}</label>
                <input class="form-control {{ $errors->has('nota') ? 'is-invalid' : '' }}" type="text" name="nota" id="nota" value="{{ old('nota', '0') }}">
                @if($errors->has('nota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.nota_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="archivo">{{ trans('cruds.examenSp.fields.archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.examenSp.fields.archivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="docente_id">{{ trans('cruds.examenSp.fields.docente') }}</label>
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
                <span class="help-block">{{ trans('cruds.examenSp.fields.docente_helper') }}</span>
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
    var uploadedArchivoMap = {}
Dropzone.options.archivoDropzone = {
    url: '{{ route('admin.examen-sps.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="archivo[]" value="' + response.name + '">')
      uploadedArchivoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedArchivoMap[file.name]
      }
      $('form').find('input[name="archivo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($examenSp) && $examenSp->archivo)
          var files =
            {!! json_encode($examenSp->archivo) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="archivo[]" value="' + file.file_name + '">')
            }
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