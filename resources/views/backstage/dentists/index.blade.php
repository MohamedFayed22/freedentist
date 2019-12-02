@extends('layouts.app')

@section('title','Dentists')

@section('content')

   
    @if(isset($objects))

        <div class="container">

            <div class="row">
 
            <div class="col-md-12">

               
                    <form action="{{route('dentistSerach')}}" method="get" class="card-content collapse show" role="form" id="filter_form" >

                        <div class="form-group col-md-4">
 <h4 class="card-title" style="margin-top:20px">Search</h4>

                            <label class="sr-only" for="s">search</label>

                            <input required name="Dentist_s" <?php if(!empty($_GET['Dentist_s'])){ ?> value="{{$_GET['Dentist_s']}}"<?php } ?> class="form-control validate[minSize[3]]" id="s" placeholder="Dentist name/mobile/email">

                            <input type="hidden" name="real_filter" value="true" />



                        </div>

                        <div class="form-group">

                            <input type="submit" value="Search" class="btn btn-info box-shadow-1  btn-min-width ml-1 mr-1">

                            <a href="{{route('showdentist')}}" class="btn btn-secondary box-shadow-1 btn-min-width">الكل</a>

                        </div>

                    </form>

                </div>

            

        
                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">

                            <div class="heading-elements">

                              <a href="{{route('adddentist')}}" class="btn btn-primary box-shadow-1  btn-min-width ml-1 mr-1">Add New</a>



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

                                            <th>Name</th>

                                            

                                            <th>Email</th>

                                            <th>Mobile</th>
                                            <th>City</th>

                                            <th class="text-center">Actions</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                          @if(count($objects))



                                          <?php

                                          $_page = (!empty($_GET['page']))?$_GET['page']:1;

                                          $counter = intval($_per_page * intval($_page - 1)) + 1;

                                          ?>



                                          @foreach($objects as $object)

                                              @if($object->admin != 2)

                                                  <tr>

                                                  <td>{{$counter}}</td>

                                                  <td>{{$object->name . " " . $object->last_name}}</td>

                                                  

                                                  <td>{{$object->email}}</td>

                                                  <td>{{$object->mobile}}</td>

                                                      <td>{{$object->city['city_name_en']}}</td>

                                                  <td><div class="container">

                                                      <div class="row">



                                                              @foreach(Auth::user()->permission as $per)



                                                              @if($per->per_name == 'edituser')



                                                          <a href="{{route('editdentist', $object->id)}}" class="btn btn-icon btn-pure info">تعديل</a>

                                                          @endif @endforeach

                                                          @foreach(Auth::user()->permission as $per)



                                                          @if($per->per_name == 'deletedentist')



                                                                <form action="{{route('deletedentist', $object->id)}}" method="post">

                                                                    {{csrf_field()}}

                                                                    {{method_field('DELETE')}}

                                                                   

                                                                    <button class="btn btn-icon btn-pure danger" type="submit"  onclick="return confirm('انت على وشك الحذف');"><i class="ft-trash-2"></i>حذف</button>



                                                                 

                                                                </form>

                                                                @endif @endforeach

                                                          </div>



                                                  </div></td>

                                              </tr>

                                              @endif

                                                    <?php $counter++; ?>

                                          @endforeach

                                      @else

                                          <tr>

                                              <td colspan="7">لا يوجد اعضاء</td>

                                          </tr>

                                      @endif

                                    </tbody>



                                    </table>

                                </div>

                                <!--Table Wrapper Finish-->

                               {{ $objects->links() }}
                                </div-->

                            </div>

                        </div>

                    </div>

                </div>

            </div>

















        </div>



    @endif



@endsection