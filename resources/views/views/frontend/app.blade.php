<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	 <script src="{{ asset('js/app.js') }}" ></script>
	 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="{{asset('public/date-time/moment.js')}}" type="text/javascript"></script>
<script src="{{asset('public/date-time/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/date-time/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/date-time/daterangepicker.js')}}" type="text/javascript"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  

<!--
<script src="{{asset('public/js/jquery-1.11.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/jquery.minicolors.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/pickerTool.js')}}" type="text/javascript"></script>
-->
 <script type="text/javascript">
 function showfollowers(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('followers').style.display = 'block';
		}
		function hidefollowers(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('followers').style.display = 'none';
		}
		function showDis(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('diseases').style.display = 'block';
		}
		function hideDis(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('diseases').style.display = 'none';
		}
		function showDrugs(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('drugs').style.display = 'block';
		}
		function hideDrugs(){
 	
			//$("#followers").show();
			//document.getElementById('followers').style.display='block';
			 document.getElementById('drugs').style.display = 'none';
		}
		$('#addService').on('click', function(event) {
			  // 	alert('d');
	   	 $('#fullCalModal').modal('show');
});

        $(function () {
            $('.date-picker').datepicker({
				 autoclose: true,
                
				format: "YYYY-MM-DD ",
                
            });
        });
		 $(function () {
            $('.time-picker').datetimepicker({
                inline: true,
				format: "HH:mm:ss",
                
            });
        });
		
    </script>
	
	
 <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>-->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   
					 Dashboard
                </a>
				 <!-- <a class="nav-link" href="{{ url('/home') }}"> Admin Dashboard</a>
             -->   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    
                        <!-- Authentication Links -->
                        @guest
                          <!--  <li class="nav-item">
                                <a class="nav-link" href=""> See Calander</a>
                            </li>-->
                             @if(isset(Auth::guard('dentist')->user()->id))
						    <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 Doctor                   {{Auth::guard('dentist')->user()->name}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                              <li class="nav-item">  
                                <a class="nav-link" href="{{route('createCalander')}}"> schedule services</a>
								</li>
                            
                                <a class="nav-link" href="{{route('dentistDashboard')}}"> Profile</a>
								 <a class="nav-link" href="{{route('upcommingAcceptedReservation')}}"> Upcoming Accepted reservation</a>
								 <a class="nav-link" href="{{route('PendingReservation')}}"> Pending reservation</a>
                                <a class="nav-link" href="{{route('prevReservationD')}}"> Previous reservation</a>
                               
								
                            
                            @endif
                        @else
						 <li class="nav-item">
                                <a class="nav-link" href="{{ route('dentistlogin') }}">Dentist {{ __('Login') }}</a>
                            </li>
                           <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dentistRegister') }}">Customer {{ __('Register') }}</a>
                                </li> 
						
                          
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                           
                           @if(isset(Auth::guard('client')->user()->id) && Auth::guard('client')->user()->admin == 2)
						    <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::guard('client')->user()->name}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                                
                                <a class="nav-link" href="{{route('clientDashboard')}}"> Customer Profile</a>
                                <a class="nav-link" href="{{route('UReservation')}}"> Upcoming reservation</a>
                                <a class="nav-link" href="{{route('prevReservation')}}"> Previous reservation</a>
							 <a class="nav-link" href="{{route('followers')}}">  Follower</a>	
                             
                            @endif
                        @else
						 <li class="nav-item">
                                <a class="nav-link" href="{{ route('clientlogin') }}">Customer {{ __('Login') }}</a>
                            </li>
                           <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clientRegister') }}">Customer {{ __('Register') }}</a>
                                </li> 
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
	@yield('script')
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
</body>
</html>
<script>
	$('.date-picker').datepicker({
               
                autoclose: true,
                todayHighlight: true
            });
</script>
