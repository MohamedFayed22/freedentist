@extends('frontend.app')

@section('content')
<!-- Main Content-->
     <main class="main-content">
      <!--aboutUs section-->
      <section class="account">
        <div class="title">
          <div class="container">
            <h2>@lang('home.privacy')</h2>
          </div>
        </div>
        <div class="container">
          <div class="content">
            <div class="row">
              <div class="col-md-4">
                <div class="aboutImg"><img src="{{ asset('public/assets/imgs/aboutus/dental.png') }}"></div>
              </div>
              <div class="col-md-8" >
                @if( app()->getLocale()=='ar')
					{!!html_entity_decode($aboutus->page_desc_ar)!!}
					@elseif( app()->getLocale()=='en')
					{!!html_entity_decode($aboutus->page_desc_en)!!}
					@endif
              </div>
            </div>
           
          </div>
        </div>
      </section>
    </main>
    <!-- End Main Content-->
@endsection
