@extends('frontend.app')

@section('content')
 <main class="main-content">
      <!--reserve section-->
      <section class="reserve">
        <div class="title">
          <div class="container">
            <h2>@lang('home.reserv')</h2>
          </div>
        </div>
		<form method="POST" action="{{ route('createReservation') }}" enctype="multipart/form-data">
                        @csrf


                       
         
						<input  type="hidden" value="<?php echo $start; ?>" name="start"/>
						<input  type="hidden" value="<?php echo $end; ?>" name="end"/>
						<input  type="hidden" value="<?php echo $hospital; ?>" name="hospital"/>
						<input  type="hidden" value="<?php echo $service; ?>" name="service"/>
						<input  type="hidden" value="<?php echo $date; ?>" name="date"/>
						<input  type="hidden" value="<?php echo $dentist; ?>" name="dentist"/>
        <div class="container">
          <div class="contentWrap">
            <div class="content2">
              <div class="row">
                <div class="col-3 col-md-2 col-lg-1">
                  <div class="icon"><img src="{{asset('public/assets/imgs/reserve/user.svg')}}"></div>
                </div>
                <div class="col-9 col-md-10 col-lg-11">
                  <h5 class="grey3">@lang('resrv.ill')</h5>
                  <h4 class="blue2">
				       
                                <input id="name" type="radio" class="form-check-input" name="user"  onclick="hidefollowers();" value="0" required  >{{$user_name}}</h4>
                                <input id="name" type="radio" class="form-check-input" name="user" onclick="showfollowers();" value="1" required >@lang('resrv.follower')


                    <div  style="display: none;" id="followers">
                                               
												<div class="col-md-6">
												<?php if(count($followers)==0){?>
										 <a href="{{route('clientDashboard')}}#flollowerModal">@lang('resrv.addFollower')</a>
													 
													<? }else{?>
                                                <select class="form-control loginInput" name="follower_id" id="follower_id" >
                                                   <!-- <option value="">@lang('Select followers')</option>-->
                                                    @foreach($followers as $follower)
                                                        <option {{(old('follower') == $follower->id)?'selected="selected"':""}} value="{{$follower->id}}">
					{{$follower->name}}
					</option>
                                                    @endforeach
                                                </select>
<?php } ?>
                                                @if ($errors->has('follower_id'))
                                                    <span class="help-block">
                                                    <strong style="color: #FF0000;">{{ $errors->first('follower_id') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                            </div>   
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-3 col-md-2 col-lg-1">
                  <div class="icon"><img src="{{asset('public/assets/imgs/reserve/broken-tooth.svg')}}"></div>
                </div>
                <div class="col-9 col-md-10 col-lg-11">
                  <h5 class="grey3">@lang('resrv.treatment')</h5>
                  <h4 class="blue2">{{$service_name[0]->service_name_ar}}</h4>
                </div>
              </div>
            </div>
            <div class="accordion" id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1">
                      <div class="icon"><img src="{{asset('public/assets/imgs/reserve/location.svg')}}"></div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <div class="row">
                        <div class="col-10">
                          <h5 class="grey3"> @lang('login.hospital') </h5>
                          <h4 class="blue2">{{$hospital_name[0]->hospital_name_ar}}</h4>
                        </div>
                        <div class="col-2">
                          <div class="requiredF"><span>*</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <div class="hospitalChoose">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="hospital" value="طيبة"> طيبة
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="hospital" value="طيبة 2">طيبة 2
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-3 col-md-2 col-lg-1">
                  <div class="icon"><img src="{{asset('public/assets/imgs/reserve/time.svg')}}"></div>
                </div>
                <div class="col-9 col-md-10 col-lg-11">
                  <h5 class="grey3">@lang('resrv.time')</h5>
				 
				  	<?php    $start_time = date('g', strtotime($start));
			  $am=date('A', strtotime($start));
			  ?>
				  
				  					  	
                  <h4 class="blue2">{{$start_time}} {{$date}}  </h4>
                </div>
              </div>
            </div>
            <div class="accordion" id="accordion2">
              <div class="card">
                <div class="card-header" id="teethHeading">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1">
                      <div class="icon"><img src="{{asset('public/assets/imgs/reserve/image.svg')}}"></div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <div class="row">
                        <div class="col-10">
                          <h5 class="grey3">@lang('resrv.attach')  </h5>
                          <h4 class="blue2">
                            <button  type="button" class="btn btn-link collapsed" id="teethImg" data-toggle="collapse" data-target="#teethCollapse" aria-expanded="true" aria-controls="teethCollapse">@lang('resrv.pic1') </button>
                          </h4>
                        </div>
                        <div class="col-2">
                          <div class="requiredF"><span>*</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="teethCollapse" aria-labelledby="teethHeading" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <div class="custom-file">
                          <input class="custom-file-input teethImg" type="file" name="photo" id="customFile">
                          <label class="custom-file-label loginInput" for="customFile">@lang('resrv.attachpic') </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <!-- <div class="accordion" id="accordion3">
              <div class="card">
                <div class="card-header" id="recordHeading">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1">
                      <div class="icon"><img src="public/assets/imgs/reserve/voice.svg"></div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <div class="row">
                        <div class="col-10">
                          <h5 class="grey3"> أرفاق </h5>
                          <h4 class="blue2">
                            <button class="btn btn-link collapsed" id="teethImg" data-toggle="collapse" data-target="#recordCollapse" aria-expanded="true" aria-controls="recordCollapse">تسجيل صوتى لوصف الحالة </button>
                          </h4>
                        </div>
                        <div class="col-2">
                          <div class="requiredF"><span>*</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="recordCollapse" aria-labelledby="recordHeading" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <div id="controls">
                          <button id="recordButton">تسجيل</button>
                          <button id="pauseButton" disabled>ايقاف موقت</button>
                          <button id="stopButton" disabled>ايقاف</button>
                        </div>
                        <div id="formats">
                          <p>ابدا بالضغط علي تسجيل</p>
                        </div>
                        <ol id="recordingsList"></ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->
              <div class="content2 checkList">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1"></div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="disease" name="is_diseases">
                      <label class="custom-control-label" for="disease">@lang('resrv.que1')</label>
                    </div>
                  </div>
                  <div class="col-3 col-md-2 col-lg-1"></div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <input class="form-control loginInput disease" name="diseases" type="text" placeholder="@lang('resrv.que2')">
                  </div>
                </div>
              </div>
              <div class="content2 checkList">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1"></div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="medicine" name="is_drugs">
                      <label class="custom-control-label" for="medicine">@lang('resrv.que3')</label>
                    </div>
                  </div>
                  <div class="col-3 col-md-2 col-lg-1"></div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <input class="form-control loginInput medicine" name="drugs" type="text" placeholder="@lang('resrv.que4')">
                  </div>
                </div>
              </div>
              <div class="reserveBtn">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1"></div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <button class="navBtn" type="submit">حجز موعد</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
		<!--<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button  class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>-->
                    </form>
					
      </section>
    </main>
	
                    
			 
						
               
       
@endsection
@section('script')
 <script>
 
       $('#hospital_id').on('change', function(event) {
		 
            var hospital_id = $(this).val();
//alert(hospital_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-ajax2') ?>",

                method: 'POST',

                data: {hospital_id:hospital_id, _token:token},

                success: function(data) {

                    $("select[name='service_id']").html('');

                    $("select[name='service_id']").html(data.options);
//alert(data.options);
                }

            });

        });
		 $('#service_id').on('change', function(event) {
		 
            var service_id = $(this).val();
			
		var hospital_id=$("#hospital_id").val();
//alert(hospital_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-day') ?>",

                method: 'POST',

                data: {service_id:service_id,hospital_id:hospital_id, _token:token},

                success: function(data) {

                    $("select[name='day']").html('');

                    $("select[name='day']").html(data.options);
//alert(data.options);
                }

            });

        });
 $('#day').on('change', function(event) {
		 
            var day = $(this).val();
            var service_id = $("#service_id").val();
			
		var hospital_id=$("#hospital_id").val();
//alert(hospital_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-date') ?>",

                method: 'POST',

                data: {service_id:service_id,hospital_id:hospital_id,day:day, _token:token},

                success: function(data) {

                    $("select[name='date']").html('');

                    $("select[name='date']").html(data.options);
                    $("select[name='time']").html('');
                    $("select[name='time']").html(data.options2);
					
//alert(data.options);
                }

            });

        });

    </script>
	
@endsection