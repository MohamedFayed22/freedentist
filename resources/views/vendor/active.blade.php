@extends('frontend.app')

@section('content')
 <main class="main-content">
      <!--register section-->
      <!--modal-->
	   <section class="register">
        <div class="title">
          <div class="container">
            <h2>@lang('mesg.msg3') </h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
      <div class="" id="registerModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <!--<button class="close" type="button" data-dismiss="modal">&times;</button>-->
            </div>
            <div class="modal-body">
              <div class="text-center">
                <h4 class="blue2">@lang('mesg.msg2')</h4>
                <!--<h4 class="blue">01117135734</h4>-->
				@if($loginerror)
				{{$loginerror}}
				@endif
				 <form method="POST" action="{{ route('ActiveActionD') }}">
                        @csrf
                <div class="code-enter">
						
                  <input class="form-control loginInput" name="otp" type="number" maxlength="4" required>
                 <!-- <input class="form-control loginInput" type="number" maxlength="1">
                  <input class="form-control loginInput" type="number" maxlength="1">
                  <input class="form-control loginInput" type="number" maxlength="1">
				  
				 -->
                </div>
				   <button type="submit" class="navBtn" id="activeBtn">@lang('mesg.msg3')</button>
				 
				  </form>
               <!-- <h5 class="grey3">أرسل كود التفعيل مرة اخرى</h5>-->
              
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
