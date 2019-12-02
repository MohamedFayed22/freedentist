@extends('frontend.app')

@section('content')
<main class="main-content">
      <!--dateDetails section-->
      <section class="dateDetails"> 
        <div class="title">
          <div class="container">
            <h2>@lang('resrv.details')</h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
            <div class="date-det">
              <h5 class="grey3">@lang('resrv.detailsID')</h5>
              <h4 class="blue2">#{{  $object[0]->event_id }}</h4>
            </div>
            <div class="date-det">
              <h5 class="grey3">@lang('resrv.patient')</h5>
              <h4 class="blue2">
			  @if($follower)
			  	{{ $follower[0]->name}}
				 @else
				{{ $object[0]->Uname }}
			  @endif
			  </h4>
            </div>
			<div class="date-det">
              <h5 class="grey3">@lang('about.dentist')</h5>
              <h4 class="blue2">
			   @if($object[0]->status!="0")
			  	{{ $object[0]->D_name}}
				@endif
				 	
				 @if($object[0]->status=="1")
				 	<a href="{{route('messages')}}">	  <img src="{{asset('public/img/chat-bubbles.png')}}" width="35"></a>
				
				 @endif
			  </h4>
            </div>
            <div class="date-det">
              <h5 class="grey3">@lang('login.hospital')</h5>
              <h4 class="blue2">{{  $object[0]->hospital_name_ar }}</h4>
            </div>
			@if(isset(Auth::guard('dentist')->user()->id))
            <!--<div class="date-det">
              <h5 class="grey3">الطبيب المعالج</h5>
              <h4 class="blue2">{{$object[0]->D_name}}</h4>
            </div>-->
			@endif
            <div class="date-det">
              <h5 class="grey3">@lang('resrv.trate')</h5>
              <h4 class="blue2">{{  $object[0]->service_name_ar }}</h4>
            </div>
            <div class="date-det">
              <h5 class="grey3"> @lang('resrv.dateTime')</h5>
			<?php    $start_time = date('h:i', strtotime($object[0]->start_time));
			  $am=date('A', strtotime($object[0]->start_time));
			  ?>
              <h4 class="blue2">{{  $object[0]->event_date }} /  {{  $start_time   }}    {{$am}}</h4>
            </div>
            <!--<div class="date-det">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="alarm" name="alarmCheck">
                <label class="custom-control-label blue" for="alarm">تفعيل التنبية</label>
              </div>
            </div>-->
            <div class="date-det">
              <h5 class="grey3">@lang('resrv.satus')</h5>
			  @if($object[0]->status=="0")
			   <h4 class="blue2">@lang('resrv.satus1')</h4>
			   @elseif($object[0]->status=="1")
			   <h4 class="blue2">@lang('resrv.satus2')</h4>
			   @elseif($object[0]->status=="2")
			   <h4 class="pink">@lang('resrv.satus4')</h4>
			   @elseif($object[0]->status=="3")
			   <h4 class="pink">@lang('resrv.satus3')</h4>
			   @elseif($object[0]->status=="5")
			   <h4 class="pink">@lang('resrv.satus6')</h4>
			  <!-- <div class="date-det">
              <h5 class="grey3">سبب الرفض</h5>
              <h4 class="pink">{{$object[0]->reason}}</h4>
            </div>-->
			  @endif
             
            </div>
            
            
            <div class="date-det">
              <h5 class="grey3">@lang('resrv.attachments')</h5>
              <div class="attach-image">
			  @if(!empty($object[0]->event_photo))
		<a href="{{asset('public/images/'.$object[0]->event_photo)}}" target="_blank">	  <img src="{{asset('public/images/'.$object[0]->event_photo)}}"></a>
			  @else
			  @lang('resrv.notfound')
			  @endif
			 
			 </div>
            </div>
			<div class="date-det">
              <h5 class="grey3">@lang('resrv.diseases')</h5>
              <div class="attach-image">
			  @if(!empty($object[0]->diseases))
			  {{$object[0]->diseases}}
			  @else
			  @lang('resrv.notfound')
			  @endif
			 
			 </div>
            </div>
			<div class="date-det">
              <h5 class="grey3">@lang('resrv.drugs')</h5>
              <div class="attach-image">
			  @if(!empty($object[0]->drugs))
			  {{$object[0]->drugs}}
			  @else
			  @lang('resrv.notfound')
			  @endif
			 
			 </div>
            </div>
			@if(isset(Auth::guard('dentist')->user()->id))
            <?php 
			$today=date('Y-m-d');
			if( $object[0]->event_date >= $today and $object[0]->status==0){?>
				
			 <div class="btns">
              <a href="{{ route('accepetReservation', $object[0]->event_id)  }}" class="navBtn">@lang('resrv.confirm')</a>
            <!--  <button class="w-btn">الغاء الحجز</button>-->
            </div>
		<?php	}
		if($object[0]->status==2){?>
			 <a href="{{ route('approveArrival', $object[0]->event_id)  }}" class="w-btn">@lang('resrv.confirm3') </a>
	<?php	}	if($object[0]->status!=5){ if($object[0]->status==0){?>
	<br/>
			 <div class="btns">
              <a href="{{ route('neglectReservation', $object[0]->event_id)  }}" class="w-btn">@lang('resrv.cancle1') </a>
			  </div>
	<?php }else{?>
			
			 <br/>
			 <div class="btns">
              <a href="{{ route('neglectReservation', $object[0]->event_id)  }}" class="w-btn">@lang('resrv.cancle') </a>
			  </div>
			  <?php }}?>
           @endif
           	@if(isset(Auth::guard('client')->user()->id))
            <?php 
			$today=date('Y-m-d');
			if( $object[0]->event_date >= $today and $object[0]->status==1 ){?>
				
			 <div class="btns">
              <a href="{{ route('accepetArr', $object[0]->event_id)  }}" class="navBtn">@lang('resrv.confirm2')</a>
			
             
            <!--  <button class="w-btn">الغاء الحجز</button>-->
            </div>
		<?php	}if($object[0]->status!=5){?>
			
			
			<br/>
			 <div class="btns">
		 <a href="{{ route('neglectArr', $object[0]->event_id)  }}" class="w-btn">@lang('resrv.cancle') </a>
				</div>
				<?php } ?>
			<!-- <div class="btns">
              <a href="{{ route('messages.create')  }}" class="navBtn">ارسال رسالة </a>
             
            </div>
		-->
			
           @endif
          </div>
        </div>
      </section>
    </main>







@endsection
