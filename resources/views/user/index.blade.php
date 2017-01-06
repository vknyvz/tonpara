@extends('layouts.master')

@section('content')
<div class="page-fixed-main-content">
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box green">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-user"></i>Kullanıcılar
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table" id="datatable">
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>İsim</th>
                    <th>E-Posta</th>
                    <th>Eklenme Tarihi</th>
                  </tr>
                </thead>
            </table>
          </div>
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
        ]
    }).on('draw.dt', function() {
      $('.dataTables_paginate').find('span.ellipsis').remove();
      $('.dataTables_filter, .dataTables_length').find('input, select').addClass('form-control');
    });
});
</script>
@endpush