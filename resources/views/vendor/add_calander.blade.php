@extends('frontend.app')

@section('content')

    <main class="main-content">
        <!--doctorSchedule section-->
        <!--addModal-->
        <div class="modal" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('createCalander') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="hospital_id" value="{{$hospital_id}}"/>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"
                                       for="service_id">@lang('resrv.service')</label>
                                <div class="col-md-6">
                                    <select class="form-control form-control-lg" name="service_id" id="service_id"
                                            required>

                                        @foreach($services as $service)
                                            <option {{(old('service') == $service->id)?'selected="selected"':""}} value="{{$service->id}}">
                                                @if( app()->getLocale()=='ar')
                                                    {{$service->service_name_ar}}
                                                @elseif( app()->getLocale()=='en')
                                                    {{$service->service_name_en}}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('service'))
                                        <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('service') }}</strong>
                                                </span>
                                    @endif


                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"
                                       for="service_id">@lang('mesg.period') </label>
                                <div class="col-md-6">
                                    <input type="checkbox" id="period" name="period" value="1"
                                           style="height: 25px;width:25px"/>
                                </div>
                            </div>
                            <div id="dayx" style="display: none;">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"
                                           for="day">@lang('resrv.day')</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="day">


                                            <option value="0">@lang('login.select')</option>
                                            <option value="Saturday">@lang('mesg.Saturday')</option>
                                            <option value="Sunday">@lang('mesg.Sunday')</option>
                                            <option value="Monday">@lang('mesg.Monday')</option>
                                            <option value="Tuesday">@lang('mesg.Tuesday')</option>
                                            <option value="Wednesday">@lang('mesg.Wednesday')</option>
                                            <option value="Thursday">@lang('mesg.Thursday')</option>
                                            <option value="Friday">@lang('mesg.Friday')</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">

                                <label class="col-md-4 col-form-label text-md-right" for="service_id"
                                       id="date_name">@lang('resrv.Date') </label>
                                <div class="col-md-6">
                                    <input type="text" name="start_date" value="" class="form-control"
                                           autocomplete="off" id="datetimepickerDate" required
                                           data-toggle="datetimepicker" data-target="#datetimepickerDate"/>

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('start_date') }}</strong>
                                                </span>
                                    @endif

                                </div>
                            </div>
                            <div id="end_datex" style="display: none;">

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"
                                           for="end_date">@lang('resrv.eDate') </label>
                                    <div class="col-md-6">

                                        <input type="text" name="end_date" value="" class="form-control"
                                               autocomplete="off" id="datetimepickerDate2" data-toggle="datetimepicker"
                                               data-target="#datetimepickerDate2"/>
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    <!--@if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong style="color: #FF0000;">{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif-->

                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">

                                <label class="col-md-4 col-form-label text-md-right"
                                       for="day">@lang('mesg.time')</label>

                                <div class="col-md-6">
                                    <input class="form-control datetimepicker-input loginInput" type="text"
                                           id="datetimepickerTime1" required="required" data-toggle="datetimepicker"
                                           name="start_time" data-target="#datetimepickerTime1" autocomplete="off">
                                <!-- 	  <select name="start_time" class="form-control">
 <?php for($i = 1;$i <= 24;$i++){
                                if($i <= '12'){
                                if($i == '12'){
                                ?>
                                        <option  value="00:00:00">{{$i}} @lang('resrv.am')</option>
	<?php }else{

                                ?>
                                        <option  value="{{$i}}:00:00">{{$i}} @lang('resrv.am')</option>
 <?php }}else{ $x = $i - 12;
                                if($i == '24'){?>
                                        <option  value="12:00:00">{{$x}} @lang('resrv.pm')</option>
 <?php }else{

                                ?>
                                        <option  value="{{$i}}:00:00">{{$x}} @lang('resrv.pm')</option>
 <?php }}
                                ?>


                                <?php } ?>
                                        </select>-->
                                </div>
                                <!-- <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerTime1" required="required" data-toggle="datetimepicker" name="start_time" data-target="#datetimepickerTime1">-->
                            </div>
                            <input class="form-control datetimepicker-input loginInput" type="hidden"
                                   id="datetimepickerTime2" value="0" name="end_time">
                        <!-- <div class="col-6">
                  <h4 class="grey3">@lang('resrv.eTime')</h4>
                  <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerTime2" required="required"  data-toggle="datetimepicker" name="end_time" data-target="#datetimepickerTime2">
                </div>-->
                    </div>
                    <div class="btns" style="margin: 20px">
                        <button class="navBtn" type="submit" id="button">@lang('login.add') </button>

                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--end addModal-->


        <section class="account">
            <div class="title">
                <div class="container">
                    <h2>@lang('mesg.calander')</h2>
                    <div class="addFavor">
                        <button class="navBtn" data-toggle="modal" data-target="#addModal"><i
                                    class="fas fa-plus"></i> @lang('mesg.addCalander')</button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="contentWrap">
                    <div class="content2">
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="days">
                            <ul class="nav nav-pills nav-justified">

                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Sunday">@lang('mesg.Sunday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Monday">@lang('mesg.Monday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Tuesday">@lang('mesg.Tuesday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Wednesday">@lang('mesg.Wednesday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Thursday">@lang('mesg.Thursday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Friday">@lang('mesg.Friday')</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Saturday">@lang('mesg.Saturday')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">


                        <?php
                        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                        foreach($days as $day){
                        //echo $day;
                        $dentist_id = Auth::guard('dentist')->user()->id;
                        $day_data = DB::table('dentist_calanders')->where('dentist_id', '=', $dentist_id)->where('day', '=', "$day")->where('dentist_calanders.flag', '=', 0)->get();
                        //dd($day_data);
                        ?>


                        <div class="tab-pane" role="tabpanel" id="{{$day}}">

                            @foreach($day_data as $dData)
                                <?php   $service = DB::table('services')->where('id', '=', $dData->service_id)->get(); ?>

                                <div class="content2">
                                    <div class="favor">
                                        <div class="row">
                                            <div class="col-10">
                                                <h4 class="blue2">
                                                    @if( app()->getLocale()=='ar')
                                                        {{$service[0]->service_name_ar}}
                                                    @elseif( app()->getLocale()=='en')
                                                        {{$service[0]->service_name_en}}
                                                    @endif
                                                    <?php
                                                    $time2 = date('h:i', strtotime($dData->start_time));
                                                    //	echo $dData->start_time;
                                                    $am = date('A', strtotime($dData->start_time)); ?>
                                                </h4>
                                                <div class="h5 grey3"><i class="far fa-clock"></i>{{$dData->start_date}} - {{$time2}} {{$am}}</div>
                                            </div>
                                            <div class="col-2">
                                                <div class="dropdown">
                                                    <button class="dots-btn dropdown-toggle" type="button" data-toggle="dropdown"><img src="{{ asset('public/assets/imgs/account/dots.svg') }}"></button>
                                                    <div class="dropdown-menu"><a class="dropdown-item grey3" href="{{url('calander/'.$dData->id)}}">@lang('login.edit')</a><a class="dropdown-item grey3" href="{{url('deletecalander/'.$dData->id)}}">@lang('login.delete')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <?php  }?>


                    </div>
                </div>
            </div>
        </section>
    </main>




@endsection


