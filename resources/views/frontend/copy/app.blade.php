<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   
 <head>
    <title>Free Dentist</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="description">
    <meta name="Sard" content="sard">
    <meta name="robots" content="index">
    <!-- ******* FavIcon ******* //-->
  
  
	 <link rel="icon" href="{{asset('assets/imgs/favicon.png?')}}" type="image/x-icon">
    <!-- ******* CSS File ******* //-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
	  <link rel="stylesheet" href="{{asset('assets/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	  <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css">
    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

	
  
    <link rel="stylesheet" href="{{asset('assets/css/dd.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/star-rating.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  
</head>
<body>
     <header class="main-header">
      <div class="container">
        <!--navigation menu-->
        <nav class="navbar navbar-expand-lg navbar-light navbarRest"><a class="navbar-brand" href="#"><img src="{{url('assets/imgs/home/logo.png')}}" alt="Free Dentist"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
              <li class="nav-item active"><a href="{{route('index')}}">الرئيسية</a></li>
              <li class="nav-item"><a href="#">حجز موعد</a></li>
              <li class="nav-item"><a href="#">@lang('home.dentists')</a></li>
              <li class="nav-item"><a href="#">@lang('home.centers') </a></li>
              <li class="nav-item"><a href="{{route('aboutus')}}"> @lang('home.about') </a></li>
              <li class="nav-item"><a href="{{route('contact')}}"> @lang('home.contact')</a></li>
              <li class="nav-item"><a href="#">
                  <div class="notifi"><i class="far fa-bell"></i><span class="notifiNum">2</span></div></a></li>
				   @if(isset(Auth::guard('dentist')->user()->id))
              <li class="nav-item">
                <div class="dropdown">
                  <button class="navBtn dropdown-toggle" type="button" data-toggle="dropdown">
                    <div class="pro-nav"><img src="{{url('assets/imgs/account/profileImg.png')}}"></div>{{Auth::guard('dentist')->user()->name}}
                  </button>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('upcommingReservation')}}">@lang('resrv.uDate')</a>
                  <a class="dropdown-item" href="{{route('upcommingAcceptedReservation')}}">@lang('resrv.uADate')</a>
                  <a class="dropdown-item" href="{{route('prevReservationD')}}">@lang('resrv.pDate')</a>
                  <a class="dropdown-item" href="{{route('messages')}}">@lang('resrv.msg') @include('messenger.unread-count')</a>
                  <a class="dropdown-item" href="{{route('dentistDashboard')}}">@lang('login.account') </a>
                  <a class="dropdown-item" href="{{route('Dlogout')}}">@lang('resrv.logout')</a>
                  </div>
                </div>
              </li>
			  @elseif(isset(Auth::guard('client')->user()->id))
              <li class="nav-item">
                <div class="dropdown">
                  <button class="navBtn dropdown-toggle" type="button" data-toggle="dropdown">
                    <div class="pro-nav"><img src="{{url('assets/imgs/account/profileImg.png')}}"></div>{{Auth::guard('client')->user()->name}}
                  </button>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('UReservation')}}">lang('resrv.uDate')</a>
                  <a class="dropdown-item" href="{{route('prevReservation')}}">@lang('resrv.pDate') </a>
                  <a class="dropdown-item" href="{{route('messages')}}">@lang('resrv.msg') @include('messenger.unread-count')</a>
                  <a class="dropdown-item" href="{{route('clientDashboard')}}">@lang('login.account') </a>
                  <a class="dropdown-item" href="{{route('Clogout')}}">@lang('resrv.logout')</a></div>
                </div>
              </li>
			  @else
						 <li class="nav-item">
						  <div class="dropdown">
						 <button class="navBtn dropdown-toggle" type="button" data-toggle="dropdown">
                                <a class="navBtn" href="#">تسجيل دخول</a>
						</button>		 
						 <div class="dropdown-menu"><a class="dropdown-item" href="{{ route('dentistlogin') }}">طبيب</a><a class="dropdown-item" href="{{ route('clientlogin') }}">مريض</a></div>		
								
                </div></div>
                            </li>
                          
								 @endif
								 
			  	  
			  
              <!--li.nav-item
              button.navBtn
                img(src="assets/imgs/home/user.svg")
                | تسجيل دخول
              -->
            </ul>
            <select class="form-control form-control-lg" name="locale" id="langSwitch" style="width:100px">
								
										<option @if( app()->getLocale()=='ar') selected="selected"  @endif value="ar">ع</option>
										<option  @if(app()->getLocale()=='en') selected="selected"  @endif	 value="en">E</option>
									</select>
          </div>
        </nav>
      </div>
    </header>
	
	    @yield('content')
 <!-- Main footer-->
    <footer class="main-footer">
      <div class="container">
        <p>جميع الحقوق محفوظة</p>
        <ul class="social">
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        </ul>
      </div>
    </footer>
    <!-- End Main footer-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="{{asset('assets/js/jquery.dd.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
   
   
    <script src="{{asset('assets/js/star-rating.min.js')}}"></script>
    <script src="{{asset('assets/js/theme.min.js')}}"></script>
    <script src="{{asset('assets/js/functions.js')}}"></script>
	<script type="text/javascript">

    $('#datetimepickerDate1').datetimepicker({

        format: 'Y-M-D'

    }); 

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(Auth::guard('client')->check()||Auth::guard('dentist')->check())
    <!-- check if pusher is allowed -->
        @if(config('chatmessenger.use_pusher'))
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/4.2.1/pusher.min.js"></script>

            <script type="text/javascript">
            
                   $(document).ready(function() {

                    $('form').submit(function(e) {
                       
                        e.preventDefault();

                        var data = $(this).serialize();
                        var url = $(this).attr('action');
                        var method = $(this).attr('method');

                        // clear textarea/ reset form
                        $(this).trigger('reset');

                        $.ajax({
                            method: method,
                            data: data,
                            url: url,
                            success: function(response) {
                            
                                var thread = $('#thread_' + response.message.thread_id);

                                $('body').find(thread).append(response.html);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });

                    var pusher = new Pusher('{{ config('pusher.connections.main.auth_key') }}', {
                        cluster: '{{ config('pusher.connections.main.options.cluster') }}',
                        encrypted: true
                    });


                    @if(isset(Auth::guard('client')->user()->id))
                    {
                        var channel = pusher.subscribe('for_user_{{ Auth::guard("client")->user()->id }}');
                    }
                    @elseif(isset(Auth::guard('dentist')->user()->id))
                    {
                        var channel = pusher.subscribe('for_user_{{ Auth::guard("dentist")->user()->id }}');
                    }
                    @endif
                    channel.bind('new_message', function(data) {
                        // console.log(data);
                        var thread = $('#' + data.div_id);
                        var thread_id = data.thread_id;
                        var thread_plain_text = data.text;
                        var thread_subject = data.thread_subject;


                        if (thread.length) {
                            // thread opened

                            // append message to thread
                            thread.append(data.html);

                            // make sure the thread is set to read
                            $.ajax({
                                url: "/messages/" + thread_id + "/read"
                            });
                        } else {
                            // thread not currently opened

                            // create message
                            var message = '<strong>' + data.sender_name + ': </strong>' + data.text + '<br/><a href="' + data.thread_url + '" class="text-right">View Message</a>';

                            // notify the user
                            toastr.success(thread_subject + '<br/>' + message);

                            // set unread count
                            let url = "{{ route('messages.unread') }}";
                            console.log(url);
                            $.ajax({
                                method: 'GET',
                                url: url,
                                success: function(data) {
                                    console.log('data from fetch: ', data);
                                    var div = $('#unread_messages');

                                    var count = data.msg_count;
                                    if (count == 0) {
                                        $(div).addClass('hidden');
                                    } else {
                                        $(div).text(count).removeClass('hidden');

                                        // if on messages.index - add alert class and update latest message
                                        $('#thread_list_' + thread_id).addClass('alert-info');
                                        $('#thread_list_' + thread_id + '_text').html(thread_plain_text);
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
        @endif
    @endif
    
    <script type="text/javascript">

    $('#datetimepickerDate1').datetimepicker({

        format: 'Y-M-D'

    }); 
	$('#langSwitch').change(function () {
var locale = $(this).val();
//	alert(locale);
var _token = $('input[name=_token]').val();
$.ajax({
	headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    },
                    type: 'POST',
                    url: "{{ url('/language') }}",
                    data: {  _token:_token ,locale:locale},
                    success: function(response) {
                                                   
                           window.location.reload(true);
						   }
						   ,error:function(){ 
      alert("error!!!!");
    }
	
                });
//$.post(url+'changeLanguage',{'local':local,'_token':_token},function (data) {
//window.location.reload(true);
//});

});
</script> 
	@yield('script')
  </body>
</html>
