@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.monitoreo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.monitoreos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fechaasesoria">{{ trans('cruds.monitoreo.fields.fechaasesoria') }}</label>
                <input class="form-control date {{ $errors->has('fechaasesoria') ? 'is-invalid' : '' }}" type="text" name="fechaasesoria" id="fechaasesoria" value="{{ old('fechaasesoria') }}">
                @if($errors->has('fechaasesoria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechaasesoria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.fechaasesoria_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="horainicio">{{ trans('cruds.monitoreo.fields.horainicio') }}</label>
                <input class="form-control timepicker {{ $errors->has('horainicio') ? 'is-invalid' : '' }}" type="text" name="horainicio" id="horainicio" value="{{ old('horainicio') }}" required>
                @if($errors->has('horainicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horainicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.horainicio_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="horafin">{{ trans('cruds.monitoreo.fields.horafin') }}</label>
                <input class="form-control timepicker {{ $errors->has('horafin') ? 'is-invalid' : '' }}" type="text" name="horafin" id="horafin" value="{{ old('horafin') }}" required>
                @if($errors->has('horafin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horafin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.horafin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="observacion">{{ trans('cruds.monitoreo.fields.observacion') }}</label>
                <textarea class="form-control {{ $errors->has('observacion') ? 'is-invalid' : '' }}" name="observacion" id="observacion" required>{{ old('observacion') }}</textarea>
                @if($errors->has('observacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.observacion_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="archivo">{{ trans('cruds.monitoreo.fields.archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
                </div>
                @if($errors->has('archivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('archivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.monitoreo.fields.archivo_helper') }}</span>
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
    url: '{{ route('admin.monitoreos.storeMedia') }}',
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
@if(isset($monitoreo) && $monitoreo->archivo)
          var files =
            {!! json_encode($monitoreo->archivo) !!}
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