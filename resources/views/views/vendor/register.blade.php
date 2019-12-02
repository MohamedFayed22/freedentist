@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dentistRegister') }}" enctype="multipart/form-data">
                        @csrf
<div class="form-group row">
                            <label for="nation_id" class="col-md-4 col-form-label text-md-right">{{ __('nation_id') }}</label>

                            <div class="col-md-6">
                                <input id="nation_id" type="text" class="form-control @error('nation_id') is-invalid @enderror" name="nation_id" value="{{ old('nation_id') }}" required autocomplete="nation_id" autofocus>

                                @error('nation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('mobile ') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="nationality">@lang('nationality')</label>
 <div class="col-md-6">
                                                <select class="form-control form-control-lg" name="nationality" id="nationality" required>
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
                                            </div>
                      <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="hospital">@lang('hospital')</label>
												<div class="col-md-6">
                                                <select class="form-control form-control-lg" name="hospital" id="hospital" required>
                                                    <option value="">@lang('login.hospital')</option>
                                                    @foreach($hospitals as $hospital)
                                                        <option {{(old('hospital') == $hospital->hospital)?'selected="selected"':""}} value="{{$hospital->id}}">@if( app()->getLocale()=='ar')
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
                                                <label class="col-md-4 col-form-label text-md-right" for="gender" >Gender</label>
												<div class="col-md-6">
                                                <select class="form-control" name="gender" id="Gender" required>
				                      <option value="">Select</option>
				                      <option value="Male">Male</option>
				                      <option value="FeMale">FeMale</option>
                                                   
                                                   
                                                </select>

                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div> 
								 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="dgree" >dgree</label>
												<div class="col-md-6">
                                                <input id="dgree" type="text" class="form-control @error('dgree') is-invalid @enderror" name="dgree" required >

                                                @if ($errors->has('dgree'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('dgree') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
											  <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">BirthDate</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="text" class="form-control date-picker" name="birthdate" >
                            </div>
                        </div> 
											 <div class="form-group col-md-8">

                                    <label for="mobile">

                                       University photo

                                    </label>



                                    <input type="file"   class="form-control" name="photo" >

                                   
                                @if ($errors->has('photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
 <div class="form-group col-md-6">

                                    <label for="mobile">

                                       Personal photo

                                    </label>



                                    <input type="file"   class="form-control" name="profile_photo" >

                                   
                                @if ($errors->has('profile_photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('profile_photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
