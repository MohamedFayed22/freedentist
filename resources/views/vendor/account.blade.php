@extends('frontend.app')



@section('content')
   <main class="main-content">
      <!--doctorAccount section-->
	
      <section class="account">
        <div class="title">
          <div class="container">
            <h2>@lang('login.account')</h2>
			  @if(Session::has('message'))
		
                    <div class="alert alert-success col-md-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!!Session::get('message')!!}
                    </div>
            @elseif(Session::has('error_message'))
                <div class="alert alert-danger col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong style="color: #FFFFFF;">{!!Session::get('error_message')!!}</strong>
                </div>
            @endif
          </div>
        </div>
	
		
        <div class="container">
          <div class="contentWrap">
            <div class="content2">
              <div class="text-center">
                <div class="profile-img"><img src="{{asset('public/images/'.Auth::guard('dentist')->user()->profile_photo)}}" width="100" style="border-radius: 50px"></div>
                <h3 class="blue">{{Auth::guard('dentist')->user()->name}}</h3>
                <div class="det">
                  <div class="h5"> <i class="fas fa-at"></i>{{Auth::guard('dentist')->user()->email}}</div>
                </div>
                <div class="det">
                  <div class="h5"><i class="fas fa-mobile-alt"></i>{{Auth::guard('dentist')->user()->mobile}}</div>
                </div>
                <!--<div class="det">
                  <div class="rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
                </div>-->
              </div>
            </div>
          </div>
		    <ul class="account-mnu">
              <li> <a class="dropdown-item" href="{{route('upcommingReservation')}}">@lang('resrv.uDate')</a></li>
              <li><a class="dropdown-item" href="{{route('upcommingAcceptedReservation')}}">@lang('resrv.uADate')</a></li>
              <li> <a class="dropdown-item" href="{{route('prevReservationD')}}">@lang('resrv.pDate')</a></li>
              <li> <a class="dropdown-item" href="{{route('messages')}}">@lang('resrv.msg') @include('messenger.unread-count')</a></li>
              <li><a href="{{url('add_calander')}}"> @lang('mesg.calander')</a></li>
            </ul>
          <div class="accordion" id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1">
                    <div class="icon"><img src="public/assets/imgs/account/medical.svg"></div>
                  </div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <h5 class="grey3">@lang('login.account')</h5>
                    <h4 class="blue2">
                     <!-- <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">طيبة</button>-->
					 <a href="{{url('Dprofile')}}">@lang('login.accountEdit')</a>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1"></div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <input class="loginInput form-control" value="طيبة">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-3 col-md-2 col-lg-1">
                  <div class="icon"><img src="public/assets/imgs/reserve/broken-tooth.svg"></div>
                </div>
                <div class="col-9 col-md-10 col-lg-11">
                  <h5 class="grey3"> @lang('mesg.calander')</h5>
                  <div class="h4 blue2">
                    <div class="button no-btn"> <a href="{{url('add_calander')}}">{{$services}}</a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <!--<div class="card-header" id="headingThree">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1">
                    <div class="icon"><img src="public/assets/imgs/account/lang.svg"></div>
                  </div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <h5 class="grey3">لغه التواصل  </h5>
                    <h4 class="blue2">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">عربى</button>
                    </h4>
                  </div>
                </div>
              </div>-->
              <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1"></div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <input class="loginInput form-control" value="عربى">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <div class="row">
                  <div class="col-3 col-md-2 col-lg-1">
                    <div class="icon"><img src="public/assets/imgs/account/social.svg"></div>
                  </div>
                  <div class="col-9 col-md-10 col-lg-11">
                    <h5 class="grey3">@lang('resrv.social')</h5>
                    <h4 class="blue2">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <ul class="socialDoc">
                          <li><a href="#"><img src="public/assets/imgs/account/Snapchat.svg"></a></li>
                          <li><a href="#"><img src="public/assets/imgs/account/Facebook.svg"></a></li>
                          <li><a href="#"><img src="public/assets/imgs/account/Twitter.svg"></a></li>
                          <li><a href="#"><img src="public/assets/imgs/account/Instagram.svg"></a></li>
                        </ul>
                      </button>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1"></div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <div class="row">
                        <div class="col-2 col-md-1"><img src="public/assets/imgs/account/Snapchat.svg"></div>
                        <div class="col-8 col-md-11">
                          <input class="loginInput form-control" placeholder="your account">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-2 col-md-1"><img src="public/assets/imgs/account/Facebook.svg"></div>
                        <div class="col-8 col-md-11">
                          <input class="loginInput form-control" placeholder="your account">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-2 col-md-1"><img src="public/assets/imgs/account/Twitter.svg"></div>
                        <div class="col-8 col-md-11">
                          <input class="loginInput form-control" placeholder="your account">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-2 col-md-1"><img src="public/assets/imgs/account/Instagram.svg"></div>
                        <div class="col-8 col-md-11">
                          <input class="loginInput form-control" placeholder="your account">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="btns">
            <button class="navBtn">تسجيل خروج</button>
          </div>-->
        </div>
      </section>
    </main>



  

@endsection

