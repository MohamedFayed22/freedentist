@extends('frontend.app')

@section('content')
 <main class="main-content">
      <!--register section-->
      <!--modal-->
      <div class="modal" id="registerModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <h4 class="blue2">من فضلك قم بإدخال الأربع الأرقام المرسلة حتى تستطيع تفعيل الحساب</h4>
                <h4 class="blue">01117135734</h4>
                <div class="code-enter">
                  <input class="form-control loginInput" type="number" maxlength="4">
                  <input class="form-control loginInput" type="number" maxlength="4">
                  <input class="form-control loginInput" type="number" maxlength="4">
                  <input class="form-control loginInput" type="number" maxlength="4">
                </div>
                <h5 class="grey3">أرسل كود التفعيل مرة اخرى</h5>
                <button class="navBtn" id="activeBtn">تفعيل الحساب</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <section class="register">
        <div class="title">
          <div class="container">
            <h2>@lang('login.register') </h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
		    <form method="POST" action="{{ route('clientRegister') }}">
                        @csrf
						
	<!--@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif-->

            <div class="form-group">
              <h4>@lang('login.name')</h4>
              <input class="form-control loginInput @error('name') is-invalid @enderror" type="text" name="name" required="">
            </div>
            <div class="form-group">
              <h4>@lang('login.mobile')</h4>
              <input class="form-control loginInput  @error('mobile') is-invalid @enderror" type="text" name="mobile" required="">
			  @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
			<div class="form-group row">
                           <h4>@lang('login.email')</h4>

                           
                                <input id="email" type="email" class="form-control loginInput @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
            <div class="form-group">
              <h4>@lang('login.password')</h4>
              <input class="form-control loginInput @error('password') is-invalid @enderror" type="password" name="password">
             @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>
            <div class="form-group">
              <h4>@lang('login.re_pass')</h4>
              <input class="form-control loginInput" type="password" name="password_confirmation">
            </div>
            <div class="form-group">
              <h4>@lang('login.gender')</h4>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Male" name="gender" checked>@lang('login.male')
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Female" name="gender">@lang('login.female')
                </label>
              </div>
            </div>
            <div class="form-group">
              <h4>@lang('login.nationality')</h4>
              <select class="form-control loginInput" name='nationality' required>
                <option>@lang('login.nationality')</option>
				 @foreach($nationalitys as $nationality)
                                                        <option {{(old('nationality_id') == $nationality->nationality_id)?'selected="selected"':""}} value="{{$nationality->id}}">@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif	
				</option>
                                                    @endforeach
              </select>
            </div>
            <div class="form-group">
              <h4>@lang('login.birthdate')</h4>
              <!--<input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerDate" name="birthdate" required data-toggle="datetimepicker" data-target="#datetimepickerDate">-->
			   <input id="datetimepickerDate1" type="text" class="form-control loginInput" value="" data-toggle="datetimepicker" data-target="#datetimepickerDate1" name="birthdate" >
            </div>
            <div class="form-group">
              <div class="form-check-inline">
                <div class="form-check-label">
                  <input class="form-check-input" required type="checkbox" value="">
			<a class="loginA" href="{{route('terms')}}"> 	  @lang('login.privacy') </a>
                </div>
              </div>
            </div>
            <div class="form-group">
			<!-- data-toggle="modal" data-target="#registerModal"-->
              <button  type="submit" class="btn-banner" >@lang('login.register') </button>
            </div>
            <div class="form-group text-center"><a class="loginA" href="{{route('clientlogin')}}">  @lang('login.hasAccount')</a></div>
			</form>
          </div>
        </div>
      </section>
    </main>



@endsection
