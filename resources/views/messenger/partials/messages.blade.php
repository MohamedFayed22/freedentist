

 <div class="msg-from">
                             
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
                             