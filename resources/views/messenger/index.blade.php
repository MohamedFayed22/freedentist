@extends('frontend.app')

@section('content')

<!-- Main Content-->
<main class="main-content">
      <!--messages section-->
      <section class="messages">
        <div class="title">
          <div class="container">
            <h2>@lang('mesg.messages') </h2>
            @include('messenger.partials.flash')
          </div>
        </div>
        <div class="container">
          <div class="contentWrap">
            <div class="content">
              <div class="row allMsgs">
                <div class="col-md-5 padd0">
                  <div class="hidden-sm-up" id="msg-mnu"><i class="fas fa-ellipsis-v"></i></div>
                  <div class="open-msgs">
                      
                    <ul class="nav nav-tabs">
                    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
                    </ul>
                  </div>
                </div>
                @if($thread)
                <div class="col-md-7 padd0" >
                  <div class="tab-content">
                    <div class="tab-pane container active" id="message1">
                            <div class="msg-head">
                              <div class="row">
                                <div class="col-6">
                                  <div class="pro-img"><img src="public/assets/imgs/messages/messageImg.png"></div>
                                </div>
                                <div class="col-6">
                                  <h4 class="blue">{{ $thread->subject }}</h4>
                                  <h5 class="grey3">أسم المستشفى</h5>
                                </div>
                              </div>
                            </div>
                            <div class="msgs">
                              <div class="message-content" id="thread_{{ $thread->id }}">


                                <?php $i=0;?>
                                  @foreach($mess as $m)
                                    @if($i % 2 == 0)
                                <div class="msg-from">
                                @else 
                                <div class="msg-to">
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                      <div class="box-msg">
                                        <p>{{$m->user->name}}</p>
                                        <p>{{ $m->body }}</p>
                                        <span class="grey3">@lang('mesg.delivered') {{ $m->created_at->diffForHumans() }} </span>
                                      </div>
                                    </div>
                                  </div>
                                 </div>
                                <?php  $i++;?>
                              @endforeach

                              </div>
                              
                            </div>
                          
                    </div>
                      @include('messenger.partials.form-message')
                    
                   
               
                  
                    </div> <!--sss-->
                  </div>
                </div>
                   @endif
                <!-- end messages-->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End Main Content-->

  
@stop
