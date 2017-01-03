@extends('layouts.login')

@section('content')
<!-- BEGIN LOGIN FORM -->
  {!! Form::open(['url' => '/login', 'class' => 'login-form', 'role' => 'form', 'method' => 'post']) !!}
      <h3 class="form-title font-green">Sign In</h3>
      
      @if ($errors->has('email') || $errors->has('password')) 
      <div class="alert alert-danger">
          <button class="close" data-close="alert"></button>
          <span> Enter correct credentials </span>
      </div>
      @endif 
      
      <div class="form-group">
          <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
          <label class="control-label visible-ie8 visible-ie9">Email</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
      <div class="form-group">
          <label class="control-label visible-ie8 visible-ie9">Password</label>
          <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
      <div class="form-actions">
          <button type="submit" class="btn green uppercase">Login</button>
          <label class="rememberme check mt-checkbox mt-checkbox-outline">
              <input type="checkbox" name="remember" value="1" />Remember
              <span></span>
          </label>
          <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
      </div>
  </form>
  {!! Form::close() !!}
<!-- END LOGIN FORM -->
@endsection
