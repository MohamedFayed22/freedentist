@extends('layouts.app')

@if(isset($aDentist))

    @section('title','Edit Dentist')

@endif

@section('title','Edit Dentist')

@section('content')



    @if(isset($aDentist))

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-content collapse show">

                            <div class="card-body">

                                <form enctype="multipart/form-data" id="page_forme"
                                      action="{{route('updatedentist', $aDentist->id)}}"
                                      class="form ls_form validate_form" method="post">

                                    {{ csrf_field() }}

                                    {{method_field('PUT')}}

                                    <div class="form-body">

                                        <h4 class="form-section"><i class="la la-paperclip"></i>Edit </h4>
                                        <div class="form-group col-md-8">
                                            <label for="nation_id"
                                                   class="col-md-4 col-form-label text-md-right">nation_id</label>


                                            <input id="nation_id" type="text"
                                                   class="form-control loginInput @error('nation_id') is-invalid @enderror"
                                                   name="nation_id" value="{{ $aDentist->nation_id }}" required
                                                   autocomplete="nation_id" autofocus>

                                            @error('nation_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-8">

                                            <label for="first_name">

                                                Name

                                            </label>

                                            <input type="text" id="name" class="form-control validate[required]"
                                                   name="name" required value="{{$aDentist->name}}" autofocus>

                                            @if ($errors->has('name'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('first_name') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                        <div class="form-group col-md-8">

                                            <label for="password">

                                                Password

                                            </label>

                                            <input type="password" id="password" value=""
                                                   class="form-control validate[required]"

                                                   name="password">

                                            @if ($errors->has('password'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                        <div class="form-group col-md-8">

                                            <label for="mobile">

                                                mobile

                                            </label>

                                            <input id="mobile" class="form-control validate[required]"
                                                   value="{{$aDentist->mobile}}" name="mobile">

                                            @if ($errors->has('mobile'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right"
                                                   for="nationality">nationality</label>
                                            <select class="form-control loginInput form-control-lg" name="nationality"
                                                    id="nationality" required>
                                                <option value="">nationality</option>
                                                @foreach($nationalitys as $nationality)
                                                    <option {{$aDentist->nationality == $nationality->id ?'selected="selected"':""}} value="{{$nationality->id}}">@if( app()->getLocale()=='ar')
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

                                        <div class="form-group col-md-8">
                                            <label class="col-form-label text-md-right" for="nationality">City</label>
                                            <select class="form-control loginInput form-control-lg" name="city" id="city" required>
                                                <option value="">City</option>
                                                @foreach($cities as $city)
                                                    <option {{$aDentist->city_id == $city->id ?'selected="selected"':""}} value="{{$city->id}}">@if( app()->getLocale()=='ar')
                                                            {{$city->city_name_ar}}
                                                        @elseif( app()->getLocale()=='en')
                                                            {{$nationality->city_name_en}}
                                                        @endif</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('city_id'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('city_id') }}</strong>
                                                </span>
                                            @endif


                                        </div>

                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right"
                                                   for="hospital">Hospital</label>

                                            <select class="form-control loginInput form-control-lg" name="hospital"
                                                    id="hospital" required>

                                                @foreach($hospitals as $hospital)
                                                    <option {{$aDentist->hospital == $hospital->id?'selected="selected"':""}} value="{{$hospital->id}}">
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

                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right"
                                                   for="gender">Gender</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="Male"
                                                           {{($aDentist->gender == 'Male')?'checked="checked"':""}} name="gender"
                                                           checked>Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="Female"
                                                           {{($aDentist->gender == 'Female')?'checked="checked"':""}} name="gender">Female
                                                </label>
                                            </div>

                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif


                                        </div>

                                        <div class="form-group col-md-8">
                                            <label class="col-form-label text-md-right"
                                                   for="dgree">Dgree</label>

                                            <input id="dgree" type="text"
                                                   class="form-control @error('dgree') is-invalid @enderror loginInput"
                                                   value="{{$aDentist->dgree}}" name="dgree" required>

                                            @if ($errors->has('dgree'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('dgree') }}</strong>
                                                </span>
                                            @endif


                                        </div>

                                        <div class="form-group col-md-8">
                                            <label for="birthdate" class=" col-form-label text-md-right">birthdate</label>


                                            <input id="birthdate" type="text" class="form-control loginInput "
                                                   name="birthdate" value="{{$aDentist->birthdate}}">

                                        </div>

                                        <div class="form-group col-md-8">

                                            <label for="mobile">

                                                @lang('login.uPhoto')

                                            </label>


                                            <input type="file" class="form-control loginInput" name="photo">
                                            <a href='{{asset('public/images/'.$aDentist->photo)}}' target='_blank'>
                                                <img class="img-thumbnail img-responsive" width="70" height="70"
                                                     src="{{asset('public/images/'.$aDentist->photo)}}" alt=""></a>
                                            @if ($errors->has('photo'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label for="mobile">

                                                @lang('login.pPhoto')

                                            </label>


                                            <input type="file" class="form-control loginInput" name="profile_photo">

                                            <img class="img-thumbnail img-responsive" width="70" height="70"
                                                 src="{{asset('public/images/'.$aDentist->profile_photo)}}" alt="">
                                            @if ($errors->has('profile_photo'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('profile_photo') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                    </div>

                                    <div class="form-actions text-center">

                                        <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1">
                                            Edit
                                        </button>

                                        <a href="{{route('showdentist')}}"
                                           class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                            Back

                                        </a></div>

                                </form>

                                <form action="{{route('permission')}}" method="post">

                                    {{csrf_field()}}

                                    <div class="card-content collapse show">

                                        <div class="card-body">

                                            <div class="card-title">

                                                <strong></strong>

                                            </div>

                                            <!--Table Wrapper Start-->


                                        </div>
                                    </div>


                                </form>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>





    @else

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-content collapse show">


                            <div class="card-body">

                                <form enctype="multipart/form-data" id="page_forme" action="{{route('storedentist')}}"
                                      class="form ls_form validate_form" method="post">

                                    {{ csrf_field() }}


                                    <div class="form-body">

                                        <h4 class="form-section"><i class="la la-paperclip"></i> Add Dentist</h4>

                                        <div class="form-group col-md-8">
                                            <label for="nation_id">Nation id</label>


                                            <input id="nation_id" type="text"
                                                   class="form-control loginInput @error('nation_id') is-invalid @enderror"
                                                   name="nation_id" value="{{ old('nation_id') }}" required
                                                   autocomplete="nation_id" autofocus>

                                            @error('nation_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-8">

                                            <label for="first_name">

                                                Name

                                            </label>

                                            <input type="text" id="name" class="form-control validate[required]"
                                                   name="name" required value="" autofocus>

                                            @if ($errors->has('name'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                            @endif

                                        </div>


                                        <div class="form-group col-md-8">

                                            <label for="email">

                                                Email

                                            </label>

                                            <input type="email" id="email" class="form-control validate[required]"

                                                   name="email">

                                            @if ($errors->has('email'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>

                                            @endif

                                        </div>


                                        <div class="form-group col-md-8">

                                            <label for="password">

                                                Password

                                            </label>

                                            <input type="password" id="password" class="form-control validate[required]"

                                                   name="password">

                                            @if ($errors->has('password'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                            @endif

                                        </div>

                                        <div class="form-group col-md-8">

                                            <label for="mobile">

                                                Mobile

                                            </label>

                                            <input id="mobile" class="form-control validate[required]" name="mobile">

                                            @if ($errors->has('mobile'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                            @endif

                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="col-form-label text-md-right" for="nationality">nationality</label>
                                            <select class="form-control loginInput form-control-lg" name="nationality"
                                                    id="nationality" required>
                                                <option value="">nationality</option>
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

                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right" for="city_id">City</label>
                                            <select class="form-control loginInput form-control-lg" name="city_id" id="city_id" required>
                                                <option value="" disabled>city</option>
                                                @foreach($cities as $city)
                                                    <option {{(old('city_id') == $city->city_id)?'selected="selected"':""}} value="{{$city->id}}">
                                                        @if( app()->getLocale()=='ar')
                                                            {{$city->city_name_ar}}
                                                        @elseif( app()->getLocale()=='en')
                                                            {{$city->city_name_en}}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('city_id'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('city_id') }}</strong>
                                                </span>
                                            @endif


                                        </div>


                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right"
                                                   for="hospital">@lang('login.hospital')</label>

                                            <select class="form-control loginInput form-control-lg" name="hospital"
                                                    id="hospital" required>

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
                                        <div class="form-group col-md-8">
                                            <label class="col-form-label text-md-right"
                                                   for="gender">Gender</label>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="Male"
                                                           name="gender" checked>Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="Female"
                                                           name="gender">Female
                                                </label>
                                            </div>

                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif


                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class=" col-form-label text-md-right"
                                                   for="dgree">Dgree</label>

                                            <input id="dgree" type="text"
                                                   class="form-control @error('dgree') is-invalid @enderror loginInput"
                                                   name="dgree" required>

                                            @if ($errors->has('dgree'))
                                                <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('dgree') }}</strong>
                                                </span>
                                            @endif


                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="birthdate" class=" col-form-label text-md-right">birthdate</label>


                                            <input id="birthdate" type="text" class="form-control loginInput "
                                                   name="birthdate">

                                        </div>
                                        <div class="form-group col-md-8">

                                            <label for="mobile">

                                                @lang('login.uPhoto')

                                            </label>


                                            <input type="file" class="form-control loginInput" name="photo">


                                            @if ($errors->has('photo'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                            @endif

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label for="mobile">

                                                @lang('login.pPhoto')

                                            </label>


                                            <input type="file" class="form-control loginInput" name="profile_photo">


                                            @if ($errors->has('profile_photo'))

                                                <span class="help-block text-danger">

                                        <strong>{{ $errors->first('profile_photo') }}</strong>

                                    </span>

                                            @endif

                                        </div>


                                    </div>


                                    <div class="form-actions text-center">

                                        <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1"><i
                                                    class="la la-check-square-o"></i>

                                            Add
                                        </button>

                                        <a href="{{route('showdentist')}}"
                                           class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                            Back

                                        </a></div>

                                </form>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endif

        </div>











@endsection