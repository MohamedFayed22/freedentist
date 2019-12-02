


 <li class="nav-item">
     <a class="nav-link"  href="{{ route('messages.show', $thread->id) }}" data-toggle="tab">
                                <div class="message">
                                  <div class="row">
                                    <div class="col-3 col-lg-2 padd0">
                                      <div class="pro-img"><img src="public/assets/imgs/messages/messageImg.png"></div>
                                    </div>
                                    <div class="col-6 col-lg-8">
                                      <h4 class="blue">{{ $thread->subject }}</h4>
                                      <h5 class="grey3">{{$thread->creator()}}</h5>
                                      <p class="text grey3"> {{ $thread->latestMessage->body }}</p>
                                    </div>
                                    <div class="col-3 col-lg-2">
                                      <h5 class="grey3 msgTime">
                                      
 
                                      </h5>
                                    </div>
                                  </div>
                              </div>
                     </a>
</li>

