@extends('frontend.app')

@section('title','المستشفيات')

@section('content')

    

    @if(isset($objects))

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="heading-elements">

                              <a href="{{route('createFollower')}}" class="btn btn-primary box-shadow-1  btn-min-width ml-1 mr-1">اضافة جديد</a>



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

                                           

                                            <th>follower name</th>

                                            <th>follower relation</th>

                                            <th class="text-center">Actions</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                          @if(($objects))



                                         



                                          @foreach($objects as $object)
 
                                          <tr>

                                          <td>{{$object->id}}</td>

                                         

                                          <td>{{$object->name}}</td>

                                          <td>{{$object->relation}}</td>

                                          <td><div class="container">

                                              <div class="row">

                                                    




                                          <a href="#" class="btn btn-icon btn-pure info"><i class="ft-settings"></i>تعديل</a>

                                                 
                                               


                                                        <form action="{{route('deleteFollower', $object->id)}}" method="post">

                                                            {{csrf_field()}}

                                                            {{method_field('DELETE')}}

                                                            <button class="btn btn-icon btn-pure danger" type="submit" onclick="return confirm('انت على وشك حذف عنصر. هل أنت متأكد ؟!');"><i class="ft-trash-2"></i>حذف</button>

                                                        </form>

                                                        

                                                  </div>



                                          </div></td>

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

                               

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>



    @endif



@endsection