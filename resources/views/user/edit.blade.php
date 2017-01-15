@extends('layouts.master')

@section('content')

<div class="page-fixed-main-content">
	<div class="row">
  	<div class="@if(isset($row->groups[0]->key) && ($row->groups[0]->key == 'super_admin' || $row->groups[0]->key == 'admin')) col-md-6 @else col-md-12 @endif">
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption font-red-sunglo">
            <i class="icon-user font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> {{ $row->exists ? 'KULLANICI `' . $row->name . '` ': 'YENİ KULLANICI' }}</span>
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
                {{ Form::select('group_id', App\Models\User\Group::get()->pluck('title', 'id'), $row->group->group_id ?? '', ['class' => 'form-control select']) }}   
                <label for="group_id">Kullanıcı Grubu</label>
              </div>
              <div class="form-group form-md-line-input">
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Kullanıcının Şifresi', 'autocomplete' => 'off']) }} 
                <label for="password">Şifre</label>
                <span class="help-block">Eğer kullanıcının şifresini değiştirmek istemiyorsan bir şey girme.</span>
              </div>
            </div>
            <div class="form-actions noborder">
              <button type="submit" class="btn blue"><i class="fa fa-save"></i> Kaydet</button>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    @if(isset($row->groups[0]->key) && ($row->groups[0]->key == 'super_admin' || $row->groups[0]->key == 'admin'))
    <div class="col-md-6">
    	<div class="portlet light bordered">
    		<div class="portlet-title">
          <div class="caption font-red-sunglo">
            <i class="icon-users font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> KULLANICI ATA </span>
            <span class="caption-helper">Bu Administratör'un kontrölü altına kullanıcılar ata.</span>           
          </div>
        </div>
        <div class="portlet-body form">
          <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
              <div class="mt-element-list">
                <div class="mt-list-head list-simple font-white bg-red">
                  <div class="list-head-title-container">
                    <h3 class="list-title">Atanan kullanıcılar</h3>
                  </div>
                </div>
                <div class="mt-list-container list-simple">
                  <ul class="list-news ext-1">
                    @foreach($row->getAdminsUsers() as $user)  
                    <li class="mt-list-item">
                      <div class="list-icon-container done">
                        <i class="icon-user"></i>
                      </div>
                      <div class="list-datetime"><a href="{{ route('user.unbind', ['id' => $user->user_id]) }}" class="btn dark btn-xs">ÇIKART</a></div>
                      <div class="list-item-content">
                        <h3>
                          <a href="javascript:;">{{ $user->name }}</a>
                        </h3>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            @php 
            $usersByGroups = \App\Models\User\GroupRelation::getUsersByGroups();
            @endphp
            <div class="portlet-body">
              <div class="mt-element-list">
                <div class="mt-list-head list-simple font-white bg-red">
                  <div class="list-head-title-container">
                    <h3 class="list-title">Tüm kullanıcılar listesi <span class="badge badge-success">{{ count($usersByGroups) }}</span></h3>
                  </div>
                </div>
                <div class="mt-list-container list-simple">                 
                  <ul>
                    @foreach($usersByGroups as $user)
                    <li class="mt-list-item">
                      <div class="list-icon-container done">
                        <i class="icon-user"></i>
                      </div>
                      <div class="list-datetime"><a href="{{ route('user.bind', ['bind_to_user_id' => $user->id, 'admin_id' => $row->id]) }}" class="btn green-haze btn-xs">Ata</a></div>
                      <div class="list-item-content">
                        <h3>{{ $user->name }}</h3>
                      </div>
                    </li>
                    
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
				</div> 
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

<style>
.mt-list-head.list-simple.font-white.bg-red { padding:7px; }
.mt-list-head.list-simple.font-white.bg-red h3 { font-size: 17px; }

</style>