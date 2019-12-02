@extends('frontend.app')

@section('content')
<main class="main-content">
      <!--upcomingDates section-->
      <section class="register">
        <div class="title">
          <div class="container">
            <h2>@lang('login.account')</h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
         
                    <form method="POST" action="{{ route('vendorpostprofile') }}" enctype="multipart/form-data">
                        @csrf
<div class="form-group row">
                            <label for="nation_id" class="col-md-4 col-form-label text-md-right">@lang('login.nation_id')</label>

                            <div class="col-md-6">
                                <input id="nation_id" type="text" class="form-control @error('nation_id') is-invalid @enderror" name="nation_id" value="{{ $client->nation_id  }}" required autocomplete="nation_id" autofocus>

                                @error('nation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('login.name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $client->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('login.email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}" required autocomplete="email">
 <input type="hidden" id="old_email" name="old_email" value="{{$client->email}}" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{--<div class="form-group row">--}}
                            {{--<label for="mobile" class="col-md-4 col-form-label text-md-right">@lang('login.mobile')</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $client->mobile }}" required autocomplete="mobile">--}}
{{--<input type="hidden" id="old_mobile" name="old_mobile" value="{{$client->mobile}}" >--}}
 {{----}}
                                {{--@error('mobile')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('login.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('login.re_pass')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="nationality">@lang('login.nationality')</label>
 <div class="col-md-6">
                                                <select class="form-control form-control-lg" name="nationality" id="nationality" required>
                                                    <option value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option {{($client->nationality == $nationality->id)?'selected="selected"':""}} value="{{$nationality->id}}">@if( app()->getLocale()=='ar')
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
                                            </div>
                      <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="hospital">@lang('login.hospital')</label>
												<div class="col-md-6">
                                                <select class="form-control form-control-lg" name="hospital" id="hospital" required>
                                                    <option value="">@lang('login.hospital')</option>
                                                    @foreach($hospitals as $hospital)
                                                        <option {{($client->hospital == $hospital->id)?'selected="selected"':""}} value="{{$hospital->id}}">@if( app()->getLocale()=='ar')
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
                                            </div>  
						 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="gender" >@lang('login.gender')</label>
												<div class="col-md-6">
                                                <select class="form-control" name="gender" id="Gender" required>
				                      <option value="">Select</option>
				                      <option value="Male" {{($client->gender == 'Male')?'selected="selected"':""}}>@lang('login.male')</option>
				                      <option {{($client->gender == 'FeMale')?'selected="selected"':""}} value="FeMale">@lang('login.female')</option>
                                                   
                                                   
                                                </select>

                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div> 
								 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="dgree" >@lang('login.dgree')</label>
												<div class="col-md-6">
                                                <input id="dgree" type="text" class="form-control @error('dgree') is-invalid @enderror" name="dgree" value="{{ $client->dgree}}" required >

                                                @if ($errors->has('dgree'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('dgree') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
											  <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">@lang('login.birthdate')</label>

                            <div class="col-md-6">
                                <input id="datetimepickerDate1" type="text" class="form-control " value="{{ $client->birthdate}}" data-toggle="datetimepicker" data-target="#datetimepickerDate1" name="birthdate" >
                            </div>
							
                        </div> 
											 <div class="form-group row">

                                    <label for="mobile" class="col-md-4 col-form-label text-md-right">

                                       @lang('login.uPhoto')

                                    </label>


<div class="col-md-6">
                                    <input type="file"   class="form-control" name="photo" >
 <img class="img-thumbnail img-responsive" width="70" height="70" src="{{asset('images/'.$client->photo)}}" alt="">

                                   
                                @if ($errors->has('photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
                                </div>
 <div class="form-group row">

                                    <label for="photo" class="col-md-4 col-form-label text-md-right">

                                         @lang('login.pPhoto')   

                                    </label>
<div class="col-md-6">


                                    <input type="file"   class="form-control" name="profile_photo" >

                      <img class="img-thumbnail img-responsive" width="70" height="70" src="{{asset('images/'.$client->profile_photo)}}" alt="">
             
                                @if ($errors->has('profile_photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('profile_photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
                                </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                 @lang('login.edit') 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
