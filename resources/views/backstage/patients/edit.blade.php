@extends('layouts.app')

@if(isset($auser))

@section('title','تعديل عضو')

@endif

@section('title','اضافة عضو')

@section('content')





@if(isset($auser))

    <div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-content collapse show">

                    <div class="card-body">

                        <form enctype="multipart/form-data" id="page_forme" action="{{route('updateuser', $auser->id)}}" class="form ls_form validate_form" method="post">

                            {{ csrf_field() }}

                            {{method_field('PUT')}}

                            <div class="form-body">

                                <h4 class="form-section"><i class="la la-paperclip"></i>تعديل العضو و اضافة الصلاحيات</h4>

                                <div class="form-group col-md-8">

                                    <label for="first_name">

                                        الاسم الأول

                                    </label>

                                    <input type="text" id="first_name" class="form-control validate[required]" name="first_name" required value="{{$auser->first_name}}" autofocus>

                                    @if ($errors->has('first_name'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('first_name') }}</strong>

                                    </span>

                                    @endif

                                </div>

                               

                                <div class="form-group col-md-8">

                                    <label for="order">

مدير                                      </label>

<br>

                                <label for="">نعم</label>

                                <input type="radio" id="order" {{($auser->admin == 1)?'checked="checked"':''}} checked="checked" value="1" class=""

                                           name="admin" >

                                           <label for="">لا</label>



                                     <input type="radio" id="order" value="0" {{($auser->admin == 0)?'checked="checked"':''}} class=" "

                                                  name="admin" >

                                    @if ($errors->has('admin'))

                                        <span class="help-block text-danger">

                                <strong>{{ $errors->first('admin') }}</strong>

                            </span>

                                    @endif

                                </div>

                                {{--<div class="form-group col-md-8">--}}

                                    {{--<label for="email">--}}

                                        {{--البريد الالكتروني--}}

                                    {{--</label>--}}

                                    {{--<input type="email" id="email" class="form-control validate[required]"--}}

                                           {{--name="email" >--}}

                                    {{--@if ($errors->has('email'))--}}

                                        {{--<span class="help-block text-danger">--}}

                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}

                                    {{--</span>--}}

                                    {{--@endif--}}

                                {{--</div>--}}

                                <div class="form-group col-md-8">

                                    <label for="password">

                                        كلمة المرور

                                    </label>

                                    <input type="password" id="password"  value="" class="form-control validate[required]"

                                           name="password" >

                                    @if ($errors->has('password'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                    @endif

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="mobile">

                                        الهاتف الجوال

                                    </label>

                                    <input id="mobile"  class="form-control validate[required]" value="{{$auser->mobile}}" name="mobile" >

                                    @if ($errors->has('mobile'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                    @endif

                                </div>

                                

                            </div>

                            <div class="form-actions text-center">

                                <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1">تعديل</button>

                                <a  href="{{route('showuser')}}" class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                    عوده

                                </a> </div>

                        </form>

                        <form action="{{route('permission')}}" method="post">

                            {{csrf_field()}}

                          <div class="card-content collapse show">

                              <div class="card-body">

                                <div class="card-title">

                                  <strong>الصلاحيات</strong>

                                </div>

                                  <!--Table Wrapper Start-->

                                  <div class="table-responsive ls-table">

                                      <table class="table table-bordered table-striped">

                                          <thead>

                                          <tr>

                                              <th>الاسم</th>

                                              <th class="text-center">عرض</th>

                                              <th class="text-center">اضافة</th>

                                              <th class="text-center">تعديل / معاينة</th>

                                              <th class="text-center">حذف</th>

                                          </tr>

                                          </thead>

                                          <tbody>

                                            <tr>

                                              <td>الاعضاء</td>

                                              <td>



                                                <input id="mobile"  @foreach($auser->permission as $per) {{($per->per_name == 'showuser')?'checked="checked"':''}}@endforeach {{($auser->admin == 1)?'checked="checked"':''}} value="1" type="checkbox" class="form-control validate[required]" name="showuser" ></td>



                                                <td><input id="per_id[]"   @foreach($auser->permission as $per) {{($per->per_name == 'adduser')?'checked="checked"':''}}@endforeach {{($auser->admin == 1)?'checked="checked"':''}} value="2" type="checkbox" class="form-control validate[required]" name="adduser" ></td>

                                                <td><input id="per_id[]"  @foreach($auser->permission as $per) {{($per->per_name == 'edituser')?'checked="checked"':''}}@endforeach {{($auser->admin == 1)?'checked="checked"':''}} value="3" type="checkbox" class="form-control validate[required]" name="edituser" ></td>

                                                <td><input id="per_id[]"  @foreach($auser->permission as $per) {{($per->per_name == 'deleteuser')?'checked="checked"':''}}@endforeach {{($auser->admin == 1)?'checked="checked"':''}} value="4" type="checkbox" class="form-control validate[required]" name="deletuser" ></td>

                                        </tr>

                                       

                                      

                                     

                                    
                                   

                                          

                                           

                                            

                                      </tbody>



                                      </table>

                                      <input type="hidden" name="user_id" value="{{$auser->id}}">

                                      <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1">اضافة </button>
                                  </div>
                              </div>
                          </div>


                        </form>



                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>





@else

    <div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-content collapse show">



                    <div class="card-body">

                        <form enctype="multipart/form-data" id="page_forme" action="{{route('storeuser')}}" class="form ls_form validate_form" method="post">

                            {{ csrf_field() }}



                            <div class="form-body">

                                <h4 class="form-section"><i class="la la-paperclip"></i> اضافة عضو</h4>

                                <div class="form-group col-md-8">

                                    <label for="first_name">

                                        الاسم الأول

                                    </label>

                                    <input type="text" id="name" class="form-control validate[required]" name="name" required value="" autofocus>

                                    @if ($errors->has('name'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('name') }}</strong>

                                    </span>

                                    @endif

                                </div>

                               

                              

                                <div class="form-group col-md-8">

                                    <label for="email">

                                        البريد الالكتروني

                                    </label>

                                    <input type="email" id="email" class="form-control validate[required]"

                                           name="email" >

                                    @if ($errors->has('email'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>

                                    @endif

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="order">

مدير                                      </label>

                                    <br>

                                <label for="">نعم</label>

                                  <input type="radio" id="order" value="1" class=""

                                           name="admin" >

                                           <label for="">لا</label>



                                     <input type="radio" id="order"  checked="checked" value="0"

                                                  name="admin" >

                                    @if ($errors->has('admin'))

                                        <span class="help-block text-danger">

                                <strong>{{ $errors->first('admin') }}</strong>

                            </span>

                                    @endif

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="password">

                                        كلمة المرور

                                    </label>

                                    <input type="password" id="password" class="form-control validate[required]"

                                           name="password" >

                                    @if ($errors->has('password'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                    @endif

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="mobile">

                                        الهاتف الجوال

                                    </label>

                                    <input id="mobile"  class="form-control validate[required]" name="mobile" >

                                    @if ($errors->has('mobile'))

                                        <span class="help-block text-danger">

                                        <strong>{{ $errors->first('mobile') }}</strong>

                                    </span>

                                    @endif

                                </div>

                               

                            </div>



                            <div class="form-actions text-center">

                                <button type="submit" class="btn btn-primary btn-min-width box-shadow-1 ml-1"> <i class="la la-check-square-o"></i>

                                    اضافة                                </button>

                                <a  href="{{route('showuser')}}" class="btn btn-warning btn-min-width box-shadow-1 mr-1"> <i class="ft-x"></i>

                                    عوده

                                </a> </div>

                        </form>



                    </div>

                </div>

            </div>

        </div>

    </div>

@endif

</div>











@endsection
