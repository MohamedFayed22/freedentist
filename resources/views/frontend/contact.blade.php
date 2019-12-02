@extends('frontend.app')

@section('content')
<!-- Main Content-->
     <main class="main-content">
      <!--contactUs section-->
      <section class="register contact">
        <div class="title">
          <div class="container">
            <h2>@lang('home.contact')</h2>
				@if (session('status'))
    <h3 style="color: red;" >{{ session('status') }}</h3>
@endif
          </div>
        </div>
	
        <div class="container">
          <div class="contentWrap">
            <div class="content2">
              <div class="contact">
                <h3 class="blue">@lang('home.map')</h3>
                <div id="map"></div>
              </div>
            </div>
            <div class="content2">
              <h3 class="blue">@lang('home.info')</h3>
              <div class="row">
                <div class="col-md-4 about"><i class="fas fa-mobile-alt"></i>
                  <h5 class="blue2"><a href="tel:{{$sets['site_mobile']}}">{{$sets['site_mobile']}}</a></h5>
                </div>
                <div class="col-md-4 about"><i class="far fa-envelope"></i>
                  <h5 class="blue2"><a href = "mailto: {{$sets['site_email']}}">{{$sets['site_email']}}</a></h5>
                </div>
                <div class="col-md-4 about"><i class="fas fa-map-marker-alt"></i>
                  <h5 class="blue2">@if( app()->getLocale()=='ar')
					{{$sets['site_address_ar']}}
					@elseif( app()->getLocale()=='en')
					{{$sets['site_address_en']}}
					@endif </h5>
                </div>
              </div>
            </div>
            <div class="content2">
              <h3 class="blue">@lang('home.contacNow')</h3>
			   <form id="contactForm" action="{{route('postcontact')}}?lang=en" method="POST" enctype="multipart/form-data">

          {{ csrf_field() }}
              <div class="form-group">
                <h5 class="blue2">@lang('login.name') </h5>
                <input class="form-control loginInput" name="contact_name" value="" type="text" required="required" data-msg-required="Please enter your name.">
				 @if ($errors->has('contact_name'))
                <span class="help-block">
                  <strong style="color: #FF0000;">{{ $errors->first('contact_name') }}</strong>
                </span>
              @endif
              </div>
              <div class="form-group">
                <h5 class="blue2">@lang('login.mobile')</h5>
                <input class="form-control loginInput @error('contact_mobile') is-invalid @enderror" type="text" name="contact_mobile" id="contact_mobile">
				 @error('contact_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="form-group">
                <h5 class="blue2">@lang('login.email')</h5>
                <input class="form-control loginInput  @error('contact_email') is-invalid @enderror" type="email" name="contact_email" id="contact_email" required="required">
				 @error('contact_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="form-group">
                <h5 class="blue2">@lang('resrv.msg')</h5>
                <textarea class="form-control loginInput @error('contact_message') is-invalid @enderror" name="contact_message" required></textarea>
				 @error('contact_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <div class="form-group text-left">
                <button type="submit" class="btn-banner">@lang('home.send')</button>
              </div>
			  </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End Main Content-->
@endsection
