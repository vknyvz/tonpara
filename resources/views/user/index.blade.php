@extends('layouts.master')

@section('content')
<div class="page-fixed-main-content">
  <div class="row">
    <div class="col-md-12">
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase">Kullanıcılar</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-toolbar">
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                	<a href="{{ route('user.create') }}">
                    <button id="" class="btn sbold green"> YENİ KULLANICI EKLE
                    	<i class="fa fa-plus"></i>
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>İsim</th>
                <th>E-Posta</th>
                <th>Grup</th>
                <th>Eklenme Tarihi</th>
                <th>İşlemler</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#datatable').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
        serverSide: true,
        "iDisplayLength": 50,
        ajax: '{!! route('user.data') !!}',
        columns: [
            { data: 'id', name: 'users.id' },
            { data: 'name', name: 'users.name' },
            { data: 'email', name: 'users.email' },
            { data: 'created_at', name: 'users.created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],     
    });
});
</script>
@endpush