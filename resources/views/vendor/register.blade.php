@extends('frontend.app')

@section('content')
 <main class="main-content">
 <section class="register">
        <div class="title">
          <div class="container">
            <h2>@lang('login.dregister')</h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
		  @if(Session::has('message'))
                    <div class="alert alert-success col-md-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!!Session::get('message')!!}
                    </div>
            @elseif(Session::has('error_message'))
                <div class="alert alert-danger col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong style="color: #000;">{!!Session::get('error_message')!!}</strong>
                </div>
            @endif
                    <form method="POST" action="{{ route('dentistRegister') }}" enctype="multipart/form-data">
                        @csrf
<div class="form-group row">
                            <h4>@lang('login.nation_id')</h4>

                         
                                <input id="nation_id" type="text" class="form-control loginInput @error('nation_id') is-invalid @enderror" name="nation_id" value="{{ old('nation_id') }}" required autocomplete="nation_id" autofocus>

                                @error('nation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      

                        <div class="form-group row">
                           <h4>@lang('login.name')</h4>

                            
                                <input id="name" type="text" class="form-control loginInput @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
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
<div class="form-group row">
                            <h4>@lang('login.mobile')</h4>

                           
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror loginInput" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group row">
                            <h4>@lang('login.password')</h4>

                           
                                <input id="password" type="password" class="form-control loginInput  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        <div class="form-group row">
                            <h4>@lang('login.re_pass')</h4>

                           
                                <input id="password-confirm" type="password" class="form-control loginInput" name="password_confirmation" required autocomplete="new-password">
                            </div>
                       
 <div class="form-group row">
                                               <h4>@lang('login.nationality')</h4>
                                       <select class="form-control loginInput form-control-lg" name="nationality" id="nationality" required>
                                                    <option value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option {{(old('nationality') == $nationality->nationality)?'selected="selected"':""}} value="{{$nationality->id}}">@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('nationality'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('nationality') }}</strong>
                                                </span>
                                                @endif

                                            
                                            </div>
                      <div class="form-group row">
                                               <h4>@lang('login.hospital')</h4>
												
                                                <select class="form-control loginInput form-control-lg" name="hospital" id="hospital" required>
                                                    
                                                    @foreach($hospitals as $hospital)
                                                        <option {{(old('hospital') == $hospital->hospital)?'selected="selected"':""}} value="{{$hospital->id}}">
														@if( app()->getLocale()=='ar')
					{{$hospital->hospital_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$hospital->hospital_name_en}}
					@endif</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('hospital'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('hospital') }}</strong>
                                                </span>
                                                @endif

                                            
                                            </div>  
						 <div class="form-group row">
                                               <h4>@lang('login.gender')</h4>
												
                                                <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Male" name="gender" checked>@lang('login.male')
                </h4>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Female" name="gender">@lang('login.female')
                </h4>
              </div>

                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif

                                           
                                            </div> 
								 <div class="form-group row">
                                               <h4>@lang('login.dgree')</h4>
												
                                               <!-- <input id="dgree" type="text" class="form-control @error('dgree') is-invalid @enderror loginInput" name="dgree" required >-->
<select id="dgree" type="text" class="form-control @error('dgree') is-invalid @enderror loginInput" name="dgree" required>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">@lang('login.entern')</option>
</select>
                                                @if ($errors->has('dgree'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('dgree') }}</strong>
                                                </span>
                                                @endif

                                            
                                            </div>
											  <div class="form-group row">
                           <h4>@lang('login.birthdate')</h4>

                             <!-- <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerDate" name="birthdate" required data-toggle="datetimepicker" data-target="#datetimepickerDate">-->
							   <input id="datetimepickerDate1" type="text" class="form-control loginInput" value="" data-toggle="datetimepicker" data-target="#datetimepickerDate1" name="birthdate" >
                             <!--   <input id="birthdate" type="text" class="form-control loginInput date-picker" name="birthdate" >-->
                           
                        </div> 
											 <div class="form-group">

                                    <h4>

                                  @lang('login.uPhoto')     

                                    </h4>



                                    <input type="file" required="required"   class="form-control loginInput" name="photo" >

                                   
                                @if ($errors->has('photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
 <div class="form-group">

                                  <h4>

                                   @lang('login.pPhoto')   

                                    </h4>



                                    <input type="file"   class="form-control loginInput" name="profile_photo" >

                                   
                                @if ($errors->has('profile_photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('profile_photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
                                 <div class="form-group">
              <div class="form-check-inline">
                <div class="form-check-label">
                  <input class="form-check-input" required type="checkbox" value="">
			<a class="loginA" href="{{route('terms')}}"> 	  @lang('login.privacy') </a>
                </div>
              </div>
            </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                  @lang('login.register')  
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
