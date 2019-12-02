@extends('frontend.app')

@section('content')
<!-- Main Content-->
     <main class="main-content">
      <!--aboutUs section-->
      <section class="account">
        <div class="title">
          <div class="container">
            <h2>@lang('home.about')</h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
            <div class="row">
              <div class="col-md-4">
                <div class="aboutImg"><img src="{{ asset('public/assets/imgs/aboutus/dental.png') }}"></div>
              </div>
              <div class="col-md-8">
                <p>@if( app()->getLocale()=='ar')
					{!!html_entity_decode($aboutus->page_desc_ar)!!}
					@elseif( app()->getLocale()=='en')
						{!!html_entity_decode($aboutus->page_desc_en)!!}
					@endif</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h3 class="aboutTitle">@lang('about.about1')</h3>
              </div>
                    <div class="col-md-4 about"><i class="far fa-calendar-alt"></i>
                      <h4>@lang('about.about2') !</h4>
                    </div>
                    <div class="col-md-4 about"><i class="fas fa-map-marker-alt"></i>
                      <h4>@lang('about.about3') !</h4>
                    </div>
                    <div class="col-md-4 about"><i class="far fa-clock"></i>
                      <h4>@lang('about.about4') !</h4>
                    </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End Main Content-->
@endsection
