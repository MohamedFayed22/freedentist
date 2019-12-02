@extends('frontend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add time to calander</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createCalander') }}" enctype="multipart/form-data">
                        @csrf
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="hospital_id">@lang('hospital')</label>
												<div class="col-md-6">
                                                <select class="form-control form-control-lg" name="hospital_id" id="hospital_id" required>
                                                    <option value="">@lang('hospital')</option>
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
                                                <label class="col-md-4 col-form-label text-md-right" for="service_id">Services</label>
 <div class="col-md-6">
                                                <select class="form-control form-control-lg" name="service_id" id="service_id" required>
                                                    <option value="">@lang('Services')</option>
                                                    @foreach($services as $service)
                                                        <option {{(old('service') == $service->id)?'selected="selected"':""}} value="{{$service->id}}">@if( app()->getLocale()=='ar')
					{{$service->service_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$service->service_name_en}}
					@endif</option>
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
                                        <label class="col-md-4 col-form-label text-md-right" for="service_id">Select Day</label> 
										 <div class="col-md-6">       
                                         <select class="form-control" name="day">
										 	<option value="">Select day</option>
										 	<option value="Saturday">Saturday</option>
										 	<option value="Sunday">Sunday</option>
										 	<option value="Monday">Monday</option>
										 	<option value="Tuesday">Tuesday</option>
										 	<option value="Wednesday">Wednesday</option>
										 	<option value="Thursday">Thursday</option>
										 	<option value="Friday">Friday</option>
										 </select>
                                            </div>
                                            </div>
											  <a id="addService" target="_blank" class="btn btn-primary" >Add services</a>
									<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title">Add Service</h4>
            </div>
            <div id="modalBody" class="modal-body"><div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="service_id">Start date </label>
 <div class="col-md-6">
                                              <input type="text" name="start_date" value="" class="form-control date-picker"  autocomplete="off" id="datetimepicker" required/>

                                                @if ($errors->has('start_date'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>                   
		<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="end_date">End date </label>
 <div class="col-md-6">
                                              <input type="text" name="end_date" value="" class="form-control date-picker"  autocomplete="off"  id="datetimepicker" required/>

                                                @if ($errors->has('end_date'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
			  
			  <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="start_time">start time </label>
 <div class="col-md-6">
                                              <input type="text" id="start_time" name="start_time" class="form-control time-picker" value="{{old('start_time')}}" required>

                                                @if ($errors->has('start_time'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('start_time') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
											  <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="end_time">End time </label>
 <div class="col-md-6">
                                              <input type="text" id="end_time" name="end_time" class="form-control time-picker" value="{{old('end_time')}}" required>

                                                @if ($errors->has('end_time'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('end_time') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
               <!-- <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>-->
            </div>
        </div>
    </div>
</div>
    

	
									 
						
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

