

 <div class="msg-from">
                             
                             <div class="row">
                                 <div class="col-12">
                                   <div class="box-msg">
                                     <p>{{$message->user->name}}</p>
                                     <p>{{ $message->body }}</p>
                                     <span class="grey3">تم الاستلام منذ {{ $message->created_at->diffForHumans() }} </span>
                                   </div>
                                 </div>
                               </div>
                              </div>
                          