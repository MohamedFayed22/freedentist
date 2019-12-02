@extends('frontend.app')

@section('content')
 <main class="main-content">
  <section class="reserve">
        <div class="title">
          <div class="container">
            <h2>@lang('login.edit') {{$object->name}}</h2>
          </div>
        </div>
      <!--doctorSchedule section-->
      <!--addModal-->
	   <div class="container">
          <div class="contentWrap">
            <div class="content2">
			 <form method="POST" action="{{ url('updateFClient/'.$object->id) }}">
                        @csrf

              <div class="form-group">
                <div class="row">
                 <!-- <div class="col-2">
                    <div class="icon"><img src="assets/imgs/reserve/user.svg"></div>
                  </div>-->
                  <div class="col-12">
                    <h4 class="grey3">@lang('login.fName')</h4>
                    <input class="form-control loginInput" name="name" required type="text" value="{{$object->name}}">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <!--<div class="col-2">
                    <div class="icon"><img src="assets/imgs/account/lang.svg"></div>
                  </div>-->
                  <div class="col-12">
                    <h4 class="grey3">@lang('login.nationality')</h4>
                  
					 <select class="form-control loginInput" name="nationality" id="nationality" required>
                                                    <option  value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option {{($object->nationality == $nationality->id)?'selected="selected"':""}}  value="{{$nationality->id}}">
					@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif
					</option>
                                                    @endforeach
                                                </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <!--<div class="col-2">
                    <div class="icon"><img src="assets/imgs/account/lang.svg"></div>
                  </div>-->
                  <div class="col-12">
                    <h4 class="grey3">@lang('login.birthdate')</h4>
                    <input class="form-control loginInput" type="text" id="datetimepickerDate1" value="{{$object->birthdate}}" name="birthdate" data-toggle="datetimepicker" data-target="#datetimepickerDate1">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h4 class="grey3">@lang('login.gender')</h4>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" {{($object->gender == 'Male')?'checked="checked"':""}} value="Male" type="radio" name="gender">
						@lang('login.male')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" value="Female" type="radio" name="gender" {{($object->gender == 'Female')?'checked="checked"':""}}>@lang('login.female')
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h4 class="grey3">@lang('login.relation')</h4>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="friend" name="relation" {{($object->relation == 'friend')?'checked="checked"':""}}>@lang('login.friend')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="brother" name="relation" {{($object->relation == 'brother')?'checked="checked"':""}}>@lang('login.brother')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" value="wife" type="radio" name="relation" {{($object->relation == 'wife')?'checked="checked"':""}}>@lang('login.wife')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="husband" name="relation" {{($object->relation == 'husband')?'checked="checked"':""}}>@lang('login.husband')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="son" name="relation" {{($object->relation == 'son')?'checked="checked"':""}}>@lang('login.son')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="daughter" name="relation" {{($object->relation == 'daughter')?'checked="checked"':""}}>@lang('login.daughter')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="father" name="relation" {{($object->relation == 'father')?'checked="checked"':""}}>@lang('login.father')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="mother" name="relation" {{($object->relation == 'mother')?'checked="checked"':""}} >@lang('login.mother')
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button class="navBtn" type="submit">@lang('login.addf') </button>
              </div>
			  </form>
			  </div>
			  </div>
			  </main>
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Follower Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('updateFClient, $object->id') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$object->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="city_id" >nationality</label>
												<div class="col-md-6">
                                                <select class="form-control" name="nationality" id="nationality" required>
                                                    <option value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option {{($object->nationality == $nationality->id)?'selected="selected"':""}} value="{{$nationality->nationality_id}}">@if( app()->getLocale()=='ar')
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
                                                <label class="col-md-4 col-form-label text-md-right" for="gender" >Gender</label>
												<div class="col-md-6">
                                                <select class="form-control" name="gender" id="Gender" required>
				                       <option value="">Select</option>
				                      <option value="Male" {{($object->gender == 'Male')?'selected="selected"':""}}>Male</option>
				                      <option value="FeMale" {{($object->gender == 'FeMale')?'selected="selected"':""}}>FeMale</option>           
                                                   
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
                                <input id="birthdate" type="text" class="form-control " name="birthdate" value="{{$object->birthdate}}" >
                            </div>
                        </div>
<div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">relation</label>

                            <div class="col-md-6">
                               <input id="relation" type="radio" class="form-control " value="Brother" name="relation" {{($object->relation == 'Brother')?'checked="checked"':""}}> Brother
					 
					             <input id="relation" type="radio" class="form-control " value="Sister" name="relation" {{($object->relation == 'Sister')?'checked="checked"':""}}>Sister
					             <input id="relation" type="radio" class="form-control " value="Friend"  name="relation" {{($object->relation == 'Friend')?'checked="checked"':""}} >Friend 
						           <input id="relation" type="radio" class="form-control " value="Father" name="relation" {{($object->relation == 'Father')?'checked="checked"':""}}>Father
						         <input id="relation" type="radio" class="form-control " value="Mother" name="relation" {{($object->relation == 'Mother')?'checked="checked"':""}}>Mother   
                            </div>
							@if ($errors->has('relation'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('relation') }}</strong>
                                                </span>
                                                @endif
                        </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
