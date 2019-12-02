@extends('frontend.app')



@section('content')
 <main class="main-content">
      <!--upcomingDates section-->
      <section class="upcomingDates">
        <div class="title">
          <div class="container">
            <h2>@lang('resrv.uDate')</h2>
          </div>
        </div>
        <div class="container">
          <div class="contentWrap">
		  @if(count($events) != 0)
		  
		   @foreach($events as $i=>$event)
                  <div class="content2">
                    <div class="row">
                      <div class="col-3 col-md-2">
                        <div class="date text-center">
						  <?php 
						  $day=date('d', strtotime($event->event_date));
						  $month=date('M', strtotime($event->event_date));
						  $dayName=date('l', strtotime($event->event_date));
						  $am=date('A', strtotime($event->start_time));
						   $start_time = date('h:i', strtotime($event->start_time));  
						  ?>
                          <h5 class="grey3">{{$dayName}}</h5>
                          <h4 class="blue">{{ $day }}</h4>
                          <h5 class="grey3">{{$month}}</h5>
                        </div>
                      </div>
                      <div class="col-9 col-md-10">
                        <div class="row border-b">
                          <div class="col-6">
                            <h5 class="grey3">@lang('resrv.time')</h5>
                            <h4 class="blue2">{{$start_time}}<span class="lightGrey">{{$am}}</span></h4>
                          </div>
                          <div class="col-6">
                            <h5 class="grey3">@lang('resrv.ill')</h5>
                            <h4 class="blue"> {{ $user[$i]->name }}</h4>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <h5 class="grey3">@lang('resrv.treatment')</h5>
                            <h4 class="blue2">{{ $treatments[$i]->service_name_ar }}</h4>
                          </div>
                          <div class="col-6">
						  <br/>
                            <a href="{{url('/details/'.$event->id) }}" class="w-btn">@lang('login.details')</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
@endforeach
         @else
		 
<h2 style="color: red">@lang('resrv.NotFound')</h2>
           @endif 
		   {{ $events->links() }}         
          </div>
        </div>
      </section>
    </main>

@endsection
