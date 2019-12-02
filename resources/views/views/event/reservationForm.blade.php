@extends('frontend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make reservation ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createReservation') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="radio" class="form-control @error('name') is-invalid @enderror" name="user" onclick="hidefollowers();" value="0" required  >Me
                                <input id="name" type="radio" class="form-control @error('name') is-invalid @enderror" name="user" onclick="showfollowers();" value="1" required >Follower

                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row" style="display: none;" id="followers">
                                                <label class="col-md-4 col-form-label text-md-right" for="follower_id"  >followers</label>
												<div class="col-md-6">
                                                <select class="form-control" name="follower_id" id="follower_id" required>
                                                    <option value="">@lang('Select followers')</option>
                                                    @foreach($followers as $follower)
                                                        <option {{(old('follower') == $follower->id)?'selected="selected"':""}} value="{{$follower->id}}">
					{{$follower->name}}
					</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('hospital_id'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('hospital_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>   
 <div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="hospital_id" >Hospitals</label>
												<div class="col-md-6">
                                                <select class="form-control" name="hospital_id" id="hospital_id" required>
                                                    <option value="">@lang('hospital')</option>
                                                    @foreach($hospitals as $hospital)
                                                        <option {{(old('hospital_id') == $hospital->id)?'selected="selected"':""}} value="{{$hospital->id}}">@if( app()->getLocale()=='ar')
					{{$hospital->hospital_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$hospital->hospital_name_en}}
					@endif</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('hospital_id'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('hospital_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="service_id" >Services</label>
												<div class="col-md-6">
                                                <select class="form-control" name="service_id" id="service_id" required>
                                                   <!-- <option value="">@lang('dentist')</option>-->
                                                    
                                                </select>

                                                @if ($errors->has('service_id'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('service_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
         
						 <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="day_id">Select Day</label> 
										 <div class="col-md-6">       
                                         <select class="form-control" name="day" id="day">
										 	<option value="">Select day</option>
										 	
										 </select>
                                            </div>
                                            </div>
						<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="date_id" >Date</label>
												<div class="col-md-6">
                                                <select class="form-control" name="date" id="date" required>
                                                   <!-- <option value="">@lang('dentist')</option>-->
                                                    
                                                </select>

                                                @if ($errors->has('date'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('date') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
<div class="form-group row">
                                                <label class="col-md-4 col-form-label text-md-right" for="date_id" >Time</label>
												<div class="col-md-6">
                                                <select class="form-control" name="time" id="time" required>
                                                   <!-- <option value="">@lang('dentist')</option>-->
                                                    
                                                </select>

                                                @if ($errors->has('time'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('time') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>
			  <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Do you have diseases</label>

                            <div class="col-md-6">
                                <input id="name" type="radio" class="form-control @error('is_diseases') is-invalid @enderror" name="is_diseases" onclick="showDis();" value="Yes" required  >Yes
                                <input id="name" type="radio" class="form-control @error('is_diseases') is-invalid @enderror" name="is_diseases" onclick="hideDis();" value="No" required >No

                                @error('is_diseases')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
					<div class="form-group row" style="display: none;" id="diseases">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> diseases Description</label>

                            <div class="col-md-6">
                              <textarea name="diseases" class="form-control"></textarea>

                                @error('diseases')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Do you have Drugs</label>

                            <div class="col-md-6">
                                <input id="name" type="radio" class="form-control @error('is_drugs') is-invalid @enderror" name="is_drugs" onclick="showDrugs();" value="Yes" required  >Yes
                                <input id="name" type="radio" class="form-control @error('is_drugs') is-invalid @enderror" name="is_drugs" onclick="hideDrugs();" value="No" required >No

                                @error('is_drugs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
					<div class="form-group row" style="display: none;" id="drugs">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> Drugs Description</label>

                            <div class="col-md-6">
                              <textarea name="drugs" class="form-control"></textarea>

                                @error('drugs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>	
						 <div class="form-group col-md-8">

                                    <label for="mobile">

                                       Teeth photo

                                    </label>



                                    <input type="file"   class="form-control" name="photo" >

                                   
                                @if ($errors->has('photo'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('photo') }}</strong>

                                    </span>

                                    @endif

                                </div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
@section('script')

@endsection