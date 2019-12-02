@extends('layouts.app')

@if(isset($auser))

@section('title','Edit Patient')

@endif

@section('title','Add Patient')

@section('content')





@if(isset($auser))

    <div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-content collapse show">

                    <div class="card-body">

                        <form enctype="multipart/form-data" id="page_forme" action="{{route('updatesick', $auser->id)}}" class="form ls_form validate_form" method="post">

                            {{ csrf_field() }}

                            {{method_field('PUT')}}

                            <div class="form-body">

                                <h4 class="form-section"><i class="la la-paperclip"></i>Edit Patient</h4>

                                <div class="form-group col-md-8">

                                    <label for="name">

                                       Name

                                    </label>

                                    <input type="text" id="name" class="form-control validate[required]" name="name" required value="{{$auser->name}}" autofocus>

                                    @if ($errors->has('name'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                    @endif

                                </div>

                               

                            

                                {{--<div class="form-group col-md-8">--}}

                                    {{--<label for="email">--}}

                                        {{--البريد الالكتروني--}}

                                    {{--</label>--}}

                                    {{--<input type="email" id="email" class="form-control validate[required]"--}}

                                           {{--name="email" >--}}

                                    {{--@if ($errors->has('email'))--}}

                                        {{--<span class="help-block text-danger">--}}

                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}

                                    {{--</span>--}}

                                    {{--@endif--}}

                                {{--</div>--}}

                                <div class="form-group col-md-8">

                                    <label for="password">

                                       Password

                                    </label>

                                    <input type="password" id="password"  value="" class="form-control validate[required]"

                                           name="password" >

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

                                    <input id="mobile"  class="form-control validate[required]" value="{{$auser->mobile}}" name="mobile" >

                                    @if ($errors->has('mobile'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                    @endif

                                </div>

                                <div class="form-group">
              <h4>Gender</h4>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" {{($auser->gender == 'Male')?'checked="checked"':""}} value="Male" name="gender" >Male
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" {{($auser->gender == 'Female')?'checked="checked"':""}} value="Female" name="gender">Female
                </label>
              </div>
            </div>
            <div class="form-group">
              <h4>nationality</h4>
              <select class="form-control loginInput" name='nationality' required>
                <option>nationality</option>
				 @foreach($nationalitys as $nationality)
                                                        <option {{($auser->nationality == $nationality->id)?'selected="selected"':""}} value="{{$nationality->id}}">@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif	
				</option>
                                                    @endforeach
              </select>
            </div>
            
            
            
            
                                       <div class="form-group ">
                                            <label class="col-form-label text-md-right" for="nationality">City</label>
                                            <select class="form-control loginInput form-control-lg" name="city" id="city" required>
                                                <option value="">City</option>
                                                @foreach($cities as $city)
                                                    <option {{$auser->city_id == $city->id ?'selected="selected"':""}} value="{{$city->id}}">@if( app()->getLocale()=='ar')
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
                                        
                                        

            
            
            <div class="form-group">
              <h4>birthdate</h4>
              <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerDate" name="birthdate" required data-toggle="datetimepicker" data-target="#datetimepickerDate" value="{{$auser->birthdate}}">
            </div>

                            </div>

                            <div class="form-actions text-center">

                                <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1">Edit</button>

                                <a  href="{{route('showuser')}}" class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                    Back

                                </a> </div>

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

                        <form enctype="multipart/form-data" id="page_forme" action="{{route('storesick')}}" class="form ls_form validate_form" method="post">

                            {{ csrf_field() }}



                            <div class="form-body">

                                <h4 class="form-section"><i class="la la-paperclip"></i> اضافة عضو</h4>

                                <div class="form-group col-md-8">

                                    <label for="name">

                                       Name

                                    </label>

                                    <input type="text" id="name" class="form-control validate[required]" name="name" required value="" autofocus>

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

                                           name="email" >

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

                                    <input type="password" id="password" required class="form-control validate[required]"

                                           name="password" >

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

                                    <input id="mobile"  class="form-control validate[required]" name="mobile" >

                                    @if ($errors->has('mobile'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                    @endif

                                </div>
<div class="form-group">
              <h4>Gender</h4>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Male" name="gender" checked>Male
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" value="Female" name="gender">Female
                </label>
              </div>
            </div>
            <div class="form-group">
              <h4>nationality</h4>
              <select class="form-control loginInput" name='nationality' required>
                <option>nationality</option>
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
            
            
            
            
              <div class="form-group col-md-8">
                                            <label class="col-form-label text-md-right" for="nationality">City</label>
                                            <select class="form-control loginInput form-control-lg" name="city" id="city" required>
                                                <option value="">City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">@if( app()->getLocale()=='ar')
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
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="form-group">
              <h4>birthdate</h4>
              <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerDate" name="birthdate" required data-toggle="datetimepicker" data-target="#datetimepickerDate">
            </div>
                               

                            </div>



                            <div class="form-actions text-center">

                                <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1"> <i class="la la-check-square-o"></i>

                                    Add                                </button>

                                <a  href="{{route('showsick')}}" class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                    Back

                                </a> </div>

                        </form>



                    </div>

                </div>

            </div>

        </div>

    </div>

@endif

</div>











@endsection