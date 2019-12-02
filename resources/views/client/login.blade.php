@extends('frontend.app')

@section('content')
<main class="main-content">
      <!--login section-->
      <section class="login">
        <div class="title">
          <div class="container">
            <h2>@lang('login.cLogin')</h2>
			 @if(Session::has('message'))
		
                    <div class="alert alert-success col-md-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!!Session::get('message')!!}
                    </div>
            @elseif(Session::has('error_message'))
                <div class="alert alert-danger col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong style="color: #FFFFFF;">{!!Session::get('error_message')!!}</strong>
                </div>
            @endif
          </div>
        </div>
		 <div class="container">
          <div class="content">
                    <form method="POST" action="{{ route('clientlogin') }}">
                        @csrf

                        <div class="form-group row">
                            <h4>@lang('login.mobile')</h4>

                            
                                <input id="mobile" type="text" class="form-control loginInput @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group row">
                           <h4>@lang('login.password')</h4>


                                <input id="password" type="password" class="form-control loginInput @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        
                        <div class="form-group row ">
                               <button type="submit" class="btn btn-primary">
                                    @lang('login.login')
                                </button>
</div>
<div class="form-group form-group-flex">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('uForgetPassword') }}">
                                     @lang('login.forget')   
                                    </a>
                                @endif
								<a class="loginA" href="{{ route('clientRegister') }}">  @lang('login.register')  </a>
								</div>
                    </form>
                </div>
            </div>
        </section>
</main>
@endsection
