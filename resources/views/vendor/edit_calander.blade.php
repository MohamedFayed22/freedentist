@extends('frontend.app')

@section('content')

 <main class="main-content">
  <section class="reserve">
        <div class="title">
          <div class="container">
            <h2>@lang('login.Uservice')</h2>
          </div>
        </div>
      <!--doctorSchedule section-->
      <!--addModal-->
	  <div class="container">
          <div class="contentWrap">
            <div class="content2">
     
			 <form method="POST" action="{{ route('updateCalander', $object->id) }}" enctype="multipart/form-data">
                        @csrf
			                           
			
			<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="service_id">@lang('resrv.service')</label>
 <div class="col-md-6">	
                                               <select class="form-control form-control-lg" name="service_id" id="service_id" required>
                                                 
                                                    @foreach($services as $service)
                                                        <option {{($object->service_id == $service->id)?'selected="selected"':""}} value="{{$service->id}}">
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
                             <!--                   <label class="col-md-4 col-form-label text-md-right" for="service_id">@lang('mesg.period') </label>
 <div class="col-md-6">		
			<input {{((strtotime($object->end_date) - strtotime($object->start_date)>'86400'))?'checked="checked"':""}} type="checkbox" id="period"  name="period" value="1" style="height: 25px;width:25px"/>
							</div>-->				
							</div>				
		<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="service_id" id="date_name">@lang('resrv.Date') </label>
 <div class="col-md-6">
 <?php $newDate = date("m/d/y", strtotime($object->start_date));    ?>
                                           <input type="text" name="start_date" value="{{$object->start_date}}"  class="form-control"  autocomplete="off" id="datetimepickerDate" required data-toggle="datetimepicker"  data-target="#datetimepickerDate"/>

                                                @if ($errors->has('start_date'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
										
		
             
               <div class="form-group row">
                  <h4 class="col-md-4 col-form-label text-md-right">@lang('mesg.time')</h4>
				  <?php   $startTime = date("HH", strtotime($object->start_time)); 
				 // echo $start_time = date('g', strtotime($object->start_time));   ?>
				  <div class="col-md-6">	
                  <!--<input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerTime1" data-toggle="datetimepicker" value="{{$object->start_time}}" name="start_time" data-target="#datetimepickerTime1">-->
                  <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerTime1" required="required" data-toggle="datetimepicker" name="start_time" data-target="#datetimepickerTime1" autocomplete="off" value="">	
			<!-- 	   <select name="start_time" class="form-control">
 <?php for($i=1;$i<=24;$i++){  $start_time = date('G', strtotime($object->start_time));?>
 	<?php for($i=1;$i<=24;$i++){ 
 if($i <= '12'){
 	if($i == '12'){
 	?>
	<option {{($start_time == '00')?'selected="selected"':""}}  value="00:00:00">{{$i}} @lang('resrv.am')</option>
	<?php }else{
 	
 ?>
 	<option {{($i == $start_time)?'selected="selected"':""}}  value="{{$i}}:00:00">{{$i}} @lang('resrv.am')</option>
 <?php } }else{ $x=$i-12 ;
 if($i == '24'){?>
 	<option {{($start_time == '12')?'selected="selected"':""}}  value="12:00:00">{{$x}} @lang('resrv.pm')</option>
 <?php }else{
 	
 ?>
 	<option {{($i == $start_time)?'selected="selected"':""}}  value="{{$i}}:00:00">{{$x}} @lang('resrv.pm')</option>
 <?php }}
 ?>
	<?php }} ?>
 </select>-->
                </div>
                </div>
               <!-- <div class="col-6">
                  <h4 class="grey3">@lang('resrv.eTime')</h4>
                  <input class="form-control datetimepicker-input loginInput" type="text" id="datetimepickerTime2" value="{{$object->end_time}}" data-toggle="datetimepicker" name="end_time" data-target="#datetimepickerTime2">
                </div>-->
              
              <div class="btns">
                <button class="navBtn" type="submit" id="button" >@lang('login.edit') </button>
               
              </div>
			  </form>
           
      <!--end addModal-->
	  
	 </div>
	 </div>
	 </div>
     </section>
    </main>
	
	
	

@endsection


