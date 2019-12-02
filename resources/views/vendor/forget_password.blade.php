@extends('frontend.app')

@section('content')
 <main class="main-content">
      <!--login section-->
      <section class="login">
        <div class="title">
          <div class="container">
            <h2>Forget Password</h2>
          </div>
        </div>
		 <div class="container">
          <div class="content">
                    <form method="POST" action="{{ route('dForgetPasswordAction') }}">
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
                           
                                <button type="submit" class="btn-banner">
                                  @lang('home.send')
                                </button>

                               </div>
								
                        
                    </form>
                </div>
            </div>
       </section>
	   </main>
@endsection
