@extends('frontend.app')

@section('content')
<main class="main-content">
 <section class="reserve">
        <div class="title">
          <div class="container">
            <h2>@lang('home.reserv')</h2>
          </div>
        </div>
                  
 <div class="container">
          <div class="contentWrap">
            <div class="content2">
			<P style="color: red">@lang('login.mesg1')</P>
 <div class="" id="myModal" style="width: 100px">
        <div class="">
          <div class="">
            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="days">
                <ul class="nav nav-pills nav-justified">
                 
                  <li class="nav-item"><a class="nav-link active"  href="{{route('index')}}">@lang('login.back')</a></li>
                  
                </ul>
                <div class="tab-content">
                 
                 
                  
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
