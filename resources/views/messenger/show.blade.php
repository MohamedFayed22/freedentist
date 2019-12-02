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
                              <div class="message-content" id="thread_{{$thread->id}}">


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
                                        <span class="grey3">تم الاستلام منذ {{ $m->created_at->diffForHumans() }} </span>
                                      </div>
                                    </div>
                                  </div>
                                 </div>
                                <?php  $i++;?>
                              @endforeach

                              </div>
                              
                            </div>
                          
                    </div>