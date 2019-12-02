@extends('frontend.app')

@section('content')
 <main class="main-content">
      <!--login section-->
      <section class="login">
        <div class="title">
          <div class="container">
            <h2>@lang('login.dLogin')</h2>
          </div>
        </div>
		 <div class="container">
          <div class="content">
                    <form method="POST" action="{{ route('dentistlogin') }}">
                        @csrf

                        <div class="form-group">
                           <h4>@lang('login.mobile')</h4>

                            
                                <input id="mobile" type="text" class="form-control loginInput @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                           <h4>@lang('login.password')</h4>

                            
                                <input id="password" type="password" class="form-control loginInput @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        

                        <div class="form-group">
                           
                                <button type="submit" class="btn-banner">
                                  @lang('login.login')
                                </button>

                               </div>
								 <div class="form-group form-group-flex"> 
                                    <a class="loginA" href="{{ route('dForgetPassword') }}">
                                    @lang('login.forget')
                                    </a>
                                <a class="loginA" href="{{ route('dentistRegister') }}">@lang('login.dregister') </a></div>
                           
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
