@extends('layouts.login')

@section('content')
<!-- BEGIN LOGIN FORM -->
  {!! Form::open(['url' => '/login', 'class' => 'login-form', 'role' => 'form', 'method' => 'post']) !!}
      <h3 class="form-title font-green">Giriş</h3>
      
      @if ($errors->has('email') || $errors->has('password')) 
      <div class="alert alert-danger">
          <button class="close" data-close="alert"></button>
          <span> Lütfen doğru kullanıcı bilgilerinizi giriniz.</span>
      </div>
      @endif 
      
      <div class="form-group">
          <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
          <label class="control-label visible-ie8 visible-ie9">E-Posta</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
      <div class="form-group">
          <label class="control-label visible-ie8 visible-ie9">Şifre</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
      <div class="form-actions">
          <button type="submit" class="btn green uppercase">GİR</button>
          <label class="rememberme check mt-checkbox mt-checkbox-outline">
              <input type="checkbox" name="remember" value="1" />Beni Hatırla
              <span></span>
          </label>
          <a href="javascript:;" id="forget-password" class="forget-password">Şifremi Unuttum</a>
      </div>
  </form>
  {!! Form::close() !!}
<!-- END LOGIN FORM -->
@endsection
