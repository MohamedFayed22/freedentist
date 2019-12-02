@extends('frontend.app')



@section('content')
  <main class="main-content">
      <!--account section-->
      <!--flollowerModal-->
      <div class="modal" id="flollowerModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
			 <form method="POST" action="{{ route('createFollower') }}">
                        @csrf

              <div class="form-group">
                <div class="row">
                  <div class="col-2">
                    <div class="icon"><img src="public/assets/imgs/reserve/user.svg"></div>
                  </div>
                  <div class="col-10">
                    <h4 class="grey3">@lang('login.fName')</h4>
                    <input class="form-control loginInput"  name="name" required type="text">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-2">
                    <div class="icon"><img src="public/assets/imgs/account/lang.svg"></div>
                  </div>
                  <div class="col-10">
                    <h4 class="grey3">@lang('login.nationality')</h4>
                  
					 <select class="form-control loginInput" name="nationality" id="nationality" required>
                                                    <option value="">@lang('login.nationality')</option>
                                                    @foreach($nationalitys as $nationality)
                                                        <option  value="{{$nationality->id}}">
					@if( app()->getLocale()=='ar')
					{{$nationality->nationality_name_ar}}
					@elseif( app()->getLocale()=='en')
					{{$nationality->nationality_name_en}}
					@endif
					</option>
                                                    @endforeach
                                                </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-2">
                    <div class="icon"><img src="public/assets/imgs/account/lang.svg"></div>
                  </div>
                  <div class="col-10">
                    <h4 class="grey3">@lang('login.birthdate')</h4>
                   <input class="form-control loginInput" type="text" id="datetimepickerDate1" value="" name="birthdate" data-toggle="datetimepicker" data-target="#datetimepickerDate1">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h4 class="grey3">@lang('login.gender')</h4>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" value="Male" type="radio" name="gender">
						@lang('login.male')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" value="Female" type="radio" name="gender">@lang('login.female')
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h4 class="grey3">@lang('login.relation')</h4>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="friend" name="relation">@lang('login.friend')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="brother" name="relation">@lang('login.brother')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" value="wife" type="radio" name="relation">@lang('login.wife')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="husband" name="relation">@lang('login.husband')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="son" name="relation">@lang('login.son')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="daughter" name="relation">@lang('login.daughter')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="father" name="relation">@lang('login.father')
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="mother" name="relation">@lang('login.mother')
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button class="navBtn" type="submit">@lang('login.addf') </button>
              </div>
			  </form>
            </div>
          </div>
        </div>
      </div>
      <!--end flollowerModal-->
      <section class="account">
        <div class="title">
          <div class="container">
            <h2>@lang('login.account')</h2>
          </div>
        </div>
        <div class="container">
          <div class="contentWrap">
            <div class="content2">
              <div class="text-center">
                <div class="profile-img"><img src="public/assets/imgs/account/profileImg.png"></div>
                <h3 class="blue">{{Auth::guard('client')->user()->name}}</h3>
                <div class="det">
                  <div class="h5"> <i class="fas fa-at"></i>{{Auth::guard('client')->user()->email}}</div>
                </div>
                <div class="det">
                  <div class="h5"><i class="fas fa-mobile-alt"></i>{{Auth::guard('client')->user()->mobile}}</div>
                </div>
              </div>
            </div>
			  <ul class="account-mnu">
              <li> <a class="dropdown-item" href="{{route('UReservation')}}">@lang('resrv.uDate')</a></li>
              <li><a class="dropdown-item" href="{{route('UAReservation')}}">@lang('resrv.uADate')</a></li>
              <li>   <a class="dropdown-item" href="{{route('prevReservation')}}">@lang('resrv.pDate') </a></li>
              <li>  <a class="dropdown-item" href="{{route('messages')}}">@lang('resrv.msg') @include('messenger.unread-count')</a></li>
                 </ul>
            <div class="accordion" id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1">
                      <div class="icon"><img src="public/assets/imgs/account/medical.svg"></div>
                    </div>
                   <!-- <div class="col-9 col-md-10 col-lg-11">
                      <h5 class="grey3">@lang('login.hospital')</h5>
                      <h4 class="blue2">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">طيبة</button>
                      </h4>
                    </div>-->
					<a href="{{route('profile')}}">@lang('login.accountEdit')</a>
                  </div>
                </div>
                <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <p>طيبة</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <div class="row">
                    <div class="col-3 col-md-2 col-lg-1">
                      <div class="icon"><img src="public/assets/imgs/account/followers.svg"></div>
                    </div>
                    <div class="col-9 col-md-10 col-lg-11">
                      <h5 class="grey3">@lang('resrv.follower')  </h5>
                      <h4 class="blue2">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">{{$followers}}</button>
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <ul>
						@foreach($Allfollowers as $follower)
                         <li><a href="{{url('editFollower/'.$follower->id)}}">{{$follower->name}}</a> 
						 <div style="width: 60%;float:left;margin-top: -20px">
			  <form  action="{{route('deleteFollower', $follower->id)}}" method="post">

                                                            {{csrf_field()}}

                                                            {{method_field('DELETE')}}

                                                            <button class="btn btn-icon btn-pure " type="submit" onclick="return confirm('انت على وشك حذف عنصر. هل أنت متأكد ؟!');"><i class="ft-trash-2"></i>@lang('login.delete')</button>

                                                        </form>	</div>		 
						 </li>
                         <!--  <li>تابع 2</li>
                          <li>تابع 3</li>-->
                          @endforeach
						  <li>
                            <button class="btnPlus" data-toggle="modal" data-target="#flollowerModal"><i class="fas fa-plus"></i><span>@lang('resrv.addFollower')</span></button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!--  <div class="card">
                <div class="card-header" id="headingThree">
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
                </div>
                <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3 col-md-2 col-lg-1"></div>
                      <div class="col-9 col-md-10 col-lg-11">
                        <p>عربى</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->
            </div>
          </div>
        <!--  <div class="btns">
            <button class="navBtn">تسجيل خروج</button>
          </div>-->
        </div>
      </section>
    </main>



  

@endsection
@section('script')
<script type='text/javascript'>
            (function() {
                'use strict';
                function remoteModal(idModal){
                    var vm = this;
                    vm.modal = $(idModal);

                    if( vm.modal.length == 0 ) {
                        return false;
                    }

                    if( window.location.hash == idModal ){
                        openModal();
                    }

                    var services = {
                        open: openModal,
                        close: closeModal
                    };

                    return services;
                    ///////////////

                    // method to open modal
                    function openModal(){
                        vm.modal.modal('show');
                    }

                    // method to close modal
                    function closeModal(){
                        vm.modal.modal('hide');
                    }
                }
                Window.prototype.remoteModal = remoteModal;
            })();

            $(function(){
                window.remoteModal('#flollowerModal');
            });
        </script>
@endsection
