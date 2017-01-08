@extends('layouts.master')

@section('content')

<div class="page-fixed-main-content">
	<div class="row">
  	<div class="col-md-12">
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption font-red-sunglo">
            <i class="icon-user font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> YENİ KULLANICI</span>
          </div>
        </div>
        <div class="portlet-body form">
        	@if (count($errors) > 0)
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>        
            @endforeach
          </div>
          @endif          
          
          {{ Form::model($row, ['route' => [$row->id ? 'user.update' : 'user.create', 'id' => $row->id], 'role' => 'form']) }}
       	    @if($row->id)
          	  {{ method_field('PUT') }}    
          	  {{ Form::hidden('id', $row->id) }}
          	@endif
            <div class="form-body">
              <div class="form-group form-md-line-input">
                {{ Form::text('name', $row->name, ['class' => 'form-control', 'placeholder' => 'Kullanıcının Tam İsmi']) }} 
                <label for="name">İsim</label>
              </div>
              <div class="form-group form-md-line-input">
                <div class="input-group">
                  <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                  </span>
                  {{ Form::text('email', $row->email, ['class' => 'form-control', 'placeholder' => 'E-Posta Adresi']) }}  
                  <label for="email">E-Posta</label>                                                  
                </div>
              </div>
              <div class="form-group form-md-line-input">
                {{ Form::select('group_id', App\Models\User\Group::get()->pluck('title', 'id'), $row->id, ['class' => 'form-control select']) }}   
                <label for="group_id">Kullanıcı Grubu</label>
              </div>
              <div class="form-group form-md-line-input">
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Kullanıcının Şifresi']) }} 
                <label for="password">Şifre</label>
                <span class="help-block">Eğer kullanıcının şifresini değiştirmek istemiyorsan bir şey girmeyin.</span>
              </div>
            </div>
            <div class="form-actions noborder">
              <button type="submit" class="btn blue"><i class="fa fa-save"></i> Kaydet</button>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection