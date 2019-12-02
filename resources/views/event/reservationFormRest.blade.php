@extends('frontend.app')

@section('content')
<main class="main-content">
 <section class="reserve">
        <div class="title">
          <div class="container">
            <h2>@lang('home.reserv')</h2>
          </div>
        </div>
                  
                        @csrf

@if($error)

{{$error}}
	

@endif
 <div class="container">
          <div class="contentWrap">
            <div class="content2">
 <div class="" id="myModal">
        <div class="">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="days">
                <ul class="nav nav-pills nav-justified">
                <!-- @foreach($other_times as $other_time)
				 @if($other_time->start_date < $date )
				 
				 @endif
				 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#day4">{{$other_time->start_date}}</a></li>
				{{ $other_time->start_time}}
				 @endforeach-->
                  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#day4">{{$date}}</a></li>
                  
                </ul>
                <div class="tab-content">
                 
                  <div class="tab-pane active" role="tabpanel" id="day4">
				  @if($times)
	

@foreach($times as $time) 
<?php
 $time1 = date('h:i', strtotime($time->start_time));
 $am = date('A', strtotime($time->start_time));
 $time2 = date('H:i', strtotime($time->end_time));
   //  $time = '6:00'; // start
    /* for ($i = $time1; $i < $time2; $i++)
     {*/
	 //	$end=$i+1;
	 /* <div class="time-available"><span><a href=" {{ url('/search/start/'.$i.'/end/'.$end.'/hospital/'.$hospital_id.'/service/'.$service_id.'/date/'.$date.'/dentist/'.$time->dentist_id) }}">{{$i}} - {{$i+1}}</a> </span></div> */ 
    ?>
  
   <a href=" {{ url('/search/start/'.$time->start_time.'/end/'.$time->end_time.'/hospital/'.$hospital_id.'/service/'.$service_id.'/date/'.$date.'/dentist/'.$time->dentist_id) }}"><div class="time-available"> <span>  {{ $time1 }}  {{$am}}</span></div> </a>   
	<?php
	//}
     
 ?>

@endforeach            
         
	@endif		
                    
                   
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>
	
					
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