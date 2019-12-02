@extends('frontend.app')

@section('content')
    <!-- Main Content-->

    <main class="main-content">
        <div class="home-back"></div>
        <!--banner section-->
        <!--modal-->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="days">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day1">1</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day2">2</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day3">3</a></li>
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#day4">4</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day5">5</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day6">6</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day7">7</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" role="tabpanel" id="day1">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="day2">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="day3">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane active" role="tabpanel" id="day4">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="day5">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="day6">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="day7">
                                    <div class="time-available"><span>8:30</span></div>
                                    <div class="time-notAvailable"><span>9:30</span></div>
                                    <div class="time-available"><span>10:30</span></div>
                                    <div class="time-available"><span>11:30</span></div>
                                    <div class="time-available"><span>12:30</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-content">
            <div class="container">
                <div class="bannerContent">
                    <h1>@lang('home.featureText1')</h1>
                    <h3>@lang('home.featureText2').</h3>
                </div>
                <div class="bannerRow">
                    <form method="GET" action="{{ route('searchReservation') }}" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-md-3 padd0">

                                <select class="form-control selectdd" name="service_id" id="service_id"
                                        required="required">
                                    <option class="locate" selected disabled
                                            data-image="{{ asset('assets/imgs/home/doctor.svg') }}">@lang('home.service')</option>
                                    @foreach($services as $service)
                                        <option {{(old('service_id') == $service->id)?'selected="selected"':""}} value="{{$service->id}}">@if( app()->getLocale()=='ar')
                                                {{$service->service_name_ar}}
                                            @elseif( app()->getLocale()=='en')
                                                {{$service->service_name_en}}
                                            @endif</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="col-md-3 padd0">
                                <select class="form-control" style="height: 59px;color:#C7C7C7;border-radius:0;width:284px;border:none;-webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: ''; " required name="city" id="city_id">
                                    <option class="locate" selected disabled data-image="{{ asset('assets/imgs/home/doctor.svg') }}">@lang('home.city')  </option>
                                <!-- @foreach($cities as $city)
                                    <option  value="{{$city->id}}">@if( app()->getLocale()=='ar')
                                        {{$city->city_name_ar}}
                                    @elseif( app()->getLocale()=='en')
                                        {{$city->city_name_en}}
                                    @endif</option>
                                  @endforeach-->
                                </select>
                            </div>
                            <div class="col-md-3 padd0">
                                <select style="height: 59px;color:#C7C7C7;border-radius:0;width:284px;border:none;-webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: ''; " class="form-control" name="hospital_id" id="hospital_id" required>
                                    <option class="locate" selected disabled data-image="{{ asset('assets/imgs/home/location.svg') }}">
                                        <span style="color:#C7C7C7;">@lang('home.center') </span></option>

                                </select>
                            </div>
                        <!-- <input class="form-control datetimepickerDate-input" type="text" id="#datepicker11" autocomplete="off" name="date" placeholder="@lang('home.time')">
              -->
                            <div class="col-md-2 padd0">
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <div class="input-group-append" data-target="#datetimepicker1"
                                         data-toggle="datepicker">
                                        <div class="input-group-text"><img src="{{asset('assets/imgs/home/calender.svg')}}"></div>
                                    </div>
                                    <input class="form-control datepicker-input" type="text"
                                           data-target="#datetimepicker1" name="date" placeholder=" @lang('home.time')">

                                </div>
                            </div>
                            <input class="form-control datepicker-input" value='2019-8-21,2019-8-24' type="hidden"
                                   id="date_id">
                            <div class="col-md-1 padd0">

                                <button type="submit" class="btn-banner">
                                    @lang('home.save')
                                </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="stepsRow">
            <div class="squareStart"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="step step1"><img src="{{ asset('assets/imgs/home/location2.svg') }}">
                        <div class="stepSquare"></div>
                        <h4>@lang('home.feature1')</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step step2">
                        <div class="stepSquare"></div>
                        <img src="assets/imgs/home/doctor2.svg">
                        <h4>@lang('home.feature2')</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step step1"><img src="assets/imgs/home/calender2.svg">
                        <div class="stepSquare"></div>
                        <h4>@lang('home.feature3')</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step step2">
                        <div class="stepSquare"></div>
                        <img src="assets/imgs/home/teeth.svg">
                        <h4>@lang('home.feature4')</h4>
                    </div>
                </div>
            </div>
            <div class="squareEnd"></div>
        </div>
        </div>
        </div>
    </main>
    <!-- End Main Content-->
@endsection
@section('script')
    <script>
        $('#service_id').on('change', function (event) {

            var service_id = $(this).val();
//alert(service_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-city') ?>",

                method: 'POST',

                data: {service_id: service_id, _token: token},

                success: function (data) {

                    $("select[name='city']").html('');

                    $("select[name='city']").html(data.options);
//alert(data.options);
                }

            });

        });
        $('#city_id').on('change', function (event) {

            var city_id = $(this).val();
//alert(city_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-hospital') ?>",

                method: 'POST',

                data: {city_id: city_id, _token: token},

                success: function (data) {

                    $("select[name='hospital_id']").html('');

                    $("select[name='hospital_id']").html(data.options);
//alert(data.options);
                }

            });

        });
        $('#hospital_id').on('change', function (event) {
            var service_id = document.getElementById('service_id').value;
            var hospital_id = $(this).val();
//alert(hospital_id);

            var token = $("input[name='_token']").val();

            $.ajax({

                url: "<?php echo route('select-date') ?>",

                method: 'POST',

                data: {hospital_id: hospital_id, service_id: service_id, _token: token},

                success: function (data) {

                    //     $("select[name='hospital_id']").html('');
                    document.getElementById('date_id').value = data.dates;
                    //  $("input[name='date_id']").html(data.dates);
                    var date_id = document.getElementById('date_id').value;
                    // alert(date_id);
                    $('#datetimepicker1').datepicker({
                        startDate: new Date(),
                        beforeShowDay: function (date) {

                            //var hilightedDays = ["2019-8-21","2019-8-24","2019-7-27"];
                            //var hilightedDays = [date_id];
                            console.log(data.dates);
//var b = JSON.parse(JSON.stringify(data.dates));
                            //var b =	JSON.stringify(data.dates);
                            var columns = jQuery.parseJSON(data.dates);
                            var hilightedDays = columns;
                            //	alert(hilightedDays);


                            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                            for (i = 0; i < hilightedDays.length; i++) {
                                if ($.inArray(y + '-' + (m + 1) + '-' + d, hilightedDays) != -1) {
                                    //return [false];
                                    return {classes: 'highlight', tooltip: 'Title'};
                                }
                            }
                        }
                    });

                    alert(data.dates);
                }
                /**/
            });

        });
    </script>
@endsection
