@extends('layouts.admin')
@section('content')
@can('examen_sp_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.examen-sps.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.examenSp.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ExamenSp', 'route' => 'admin.examen-sps.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.examenSp.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ExamenSp">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.programaacademico') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.programamodular') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.titulo') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.fecha') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.horainicio') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.horafin') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.nota') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.archivo') }}
                    </th>
                    <th>
                        {{ trans('cruds.examenSp.fields.docente') }}
                    </th>
                    <th>
                        {{ trans('cruds.docente.fields.direccion') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($programa_modulars as $key => $item)
                                <option value="{{ $item->nombreprograma }}">{{ $item->nombreprograma }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($programa_modulars as $key => $item)
                                <option value="{{ $item->nombreprograma }}">{{ $item->nombreprograma }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($docentes as $key => $item)
                                <option value="{{ $item->dni }}">{{ $item->dni }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('examen_sp_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.examen-sps.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.examen-sps.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'programaacademico_nombreprograma', name: 'programaacademico.nombreprograma' },
{ data: 'programamodular_nombreprograma', name: 'programamodular.nombreprograma' },
{ data: 'titulo', name: 'titulo' },
{ data: 'fecha', name: 'fecha' },
{ data: 'horainicio', name: 'horainicio' },
{ data: 'horafin', name: 'horafin' },
{ data: 'nota', name: 'nota' },
{ data: 'archivo', name: 'archivo', sortable: false, searchable: false },
{ data: 'docente_dni', name: 'docente.dni' },
{ data: 'docente.direccion', name: 'docente.direccion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ExamenSp').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection