@extends('frontend.app')

@section('title','Dashboard')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs tabs-vertical tabs-right tabs-primary">
                    <div class="tab-content">
                        {{--profile--}}
                        <div id="account" class="tab-pane active">
                            <div class="box-content">
                                <h4>Profile update</h4>
                                <form enctype="multipart/form-data" class="form-horizontal form-simple" method="POST" action="{{ route('postprofile') }}" >
                                    {{ csrf_field() }}

                                    @if (isset($error))
                                        <p style="text-align:center;color:red;direction:rtl">
                                            <strong>{{$error}} !</strong>
                                        </p>
                                    @endif

                                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}"  autocomplete="email">
								 <input type="hidden" id="old_email" name="old_email" value="{{$client->email}}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('mobile Address') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $client->mobile }}" required autocomplete="mobile">
 <input type="hidden" id="old_mobile" name="old_mobile" value="{{$client->mobile}}" >
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="city_id" >nationality</label>
												<div class="col-md-6">
                                                <select class="form-control" name="nationality" id="nationality_id" required>
                                                    <option value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option {{($client->nationality == $nationality->nationality_id)?'selected="selected"':""}} value="{{$nationality->nationality_id}}">@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('city_id'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('city_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
  
  <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="gender" >nationality</label>
												<div class="col-md-6">
                                                <select class="form-control" name="gender" id="Gender" required>
				                      <option value="">Male</option>
				                      <option value="">FeMale</option>
                                                   
                                                   
                                                </select>

                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>                   
						  <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">BirthDate</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="text" class="form-control date-picker" value="{{$client->birthdate}}" name="birthdate" >
                            </div>
                        </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                            </div>
                        </div>
                                </form>
                            </div>
                        </div>

                       

                    </div>
                   
                </div>
            </div>
        </div>


    </div>

@endsection

