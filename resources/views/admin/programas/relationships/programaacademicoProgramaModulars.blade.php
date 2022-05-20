@can('programa_modular_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.programa-modulars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.programaModular.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.programaModular.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-programaacademicoProgramaModulars">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.programaModular.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.programaModular.fields.programaacademico') }}
                        </th>
                        <th>
                            {{ trans('cruds.programaModular.fields.nombreprograma') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programaModulars as $key => $programaModular)
                        <tr data-entry-id="{{ $programaModular->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $programaModular->id ?? '' }}
                            </td>
                            <td>
                                {{ $programaModular->programaacademico->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $programaModular->nombreprograma ?? '' }}
                            </td>
                            <td>
                                @can('programa_modular_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.programa-modulars.show', $programaModular->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('programa_modular_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.programa-modulars.edit', $programaModular->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('programa_modular_delete')
                                    <form action="{{ route('admin.programa-modulars.destroy', $programaModular->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('programa_modular_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.programa-modulars.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-programaacademicoProgramaModulars:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection