@extends('layouts.app')

@section('title','Orders')

@section('content')



    @if(isset($objects))

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="heading-elements">
                            <!--
                              <a href="{{route('addoffer')}}" class="btn btn-primary box-shadow-1  btn-min-width ml-1 mr-1">Add New</a>
-->Previous Orders


                            </div>

                        </div>

                        <div class="card-content collapse show">

                            <div class="card-body">

                                <!--Table Wrapper Start-->

                                <div class="table-responsive ls-table">

                                    <table class="table table-bordered table-striped">

                                        <thead>

                                        <tr>

                                            <th>#</th>


                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Treatment</th>
                                            <th>User</th>


                                            <!--  <th class="text-center">Actions</th>
  -->
                                        </tr>

                                        </thead>

                                        <tbody>

                                        @if(($objects))







                                            @foreach($objects as $i=>$object)

                                                <tr>

                                                    <td>{{$object->id}}</td>


                                                    <td>
                                                        {{$object->event_date}}

                                                    </td>
                                                    <td>
                                                        {{$object->start_time}} -{{$object->end_time}}


                                                    </td>
                                                    <td>
                                                        @if($object->status == '0')
                                                            Pending
                                                        @elseif($object->status == '1')
                                                            Accepted
                                                        @elseif($object->status == '3')
                                                            Canceled
                                                        @endif
                                                    </td>
                                                    <td>{{ $treatments[$i]->service_name_ar }}</td>
                                                    <td>{{ $user[$i]['name'] }}</td>
                                                    <td><a href="{{url('home/orders/Showdetails/'.$object->id )}}">Details</a>
                                                    </td>
                                                    <td>
                                                        <div class="container">

                                                        <!--  <div class="row">

                                                      @foreach(Auth::user()->permission as $per)

                                                            @if($per->per_name == 'editoffer')



                                                                <a href="{{route('editoffer', $object->id)}}" class="btn btn-icon btn-pure info"><i class="ft-settings"></i>تعديل</a>

                                                  @endif @endforeach

                                                        @foreach(Auth::user()->permission as $per)



                                                            @if($per->per_name == 'deleteoffer')



                                                                <form action="{{route('deleteoffer', $object->id)}}" method="post">

                                                            {{csrf_field()}}

                                                                {{method_field('DELETE')}}

                                                                        <button class="btn btn-icon btn-pure danger" type="submit" onclick="return confirm('انت على وشك حذف عنصر. هل أنت متأكد ؟!');"><i class="ft-trash-2"></i>حذف</button>

                                                                    </form>

@endif @endforeach

                                                                </div>-->


                                                        </div>
                                                    </td>

                                                </tr>





                                            @endforeach

                                        @else

                                            <tr>

                                                <td colspan="7">لا يوجد مستشفيات</td>

                                            </tr>

                                        @endif

                                        </tbody>


                                    </table>

                                </div>

                                <!--Table Wrapper Finish-->

                                {{ $objects->links() }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>



    @endif



@endsection