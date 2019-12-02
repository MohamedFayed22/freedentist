@extends('layouts.app')
@section('title','الرئيسية')
@section('content')
            <div class="row">
                <div class="col-lg-6 col-12">
                  <a href="{{route('showproduct')}}">

                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class=" text-success">المنتجات</h6>
                                        <h3 class=" text-success">{{$products}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="la la-files-o success font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card pull-up">
                      <a href="{{route('showorder')}}">

                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">طلبات الشراء</h6>
                                        <h3>{{$orders}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="la la-shopping-cart text-muted dark font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </a>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <a href="{{route('showuser')}}">

                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-primary">مديرين التطبيق</h6>
                                        <h3 class="text-primary">{{$users}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-users primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-6 col-12">
                  <a href="{{route('showclient')}}">

                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-info">العملاء</h6>
                                        <h3 class="text-info">{{$clients}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="la la-user info font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-6 col-12">
                    <a href="{{route('showlaundry')}}">

                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-secondary">المغاسل</h6>
                                            <h3 class="text-secondary">{{$laundries}}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="la la-car dark text-muted font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-12">
                    <a href="{{route('searchlaundryrequest')}}?s=1&real_filter=true">

                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h6 class="text-warning">طلبات إضافة مغاسل لم تتم الموافقة عليها بعد</h6>
                                            <h3 class="text-warning">{{$laundryrequests}}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="la la-car warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>
                <div class="col-lg-6 col-12">
                  <a href="{{route('showcontact')}}">

                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-danger">رسائل اتصل بنا</h6>
                                        <h3 class="text-danger">{{$msg}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="la la-envelope danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-6 col-12">
                  <a href="{{route('showpage')}}">

                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">الصفحات</h6>
                                        <h3>{{$pages}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="la la-book dark text-muted font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></a>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h5 class="text-success"style="margin-bottom: 18px"><i class="la la-sitemap success font-large-1"></i><strong> التصنيفات</strong></h5>
                                        <div class="container">
                                            <div class="table-responsive ls-table">
                                                <table class="table table ">
                                                    <tr>
                                                        <th>التصنيف</th>
                                                        <th>عدد المنتجات</th>
                                                    </tr>
                                                    @foreach($cats as $cat)
                                                        <tr>
                                                            <td>{{$cat->cat_name_ar}}</td>
                                                            <td>
                                                              <a  href="{{route('searchproduct')}}?s=&real_filter=true&product_cat={{$cat->cat_id}}&product_status=">
                                                                  {{count($cat->product)}}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="align-self-center">--}}
                                        {{--<i class="la la-sitemap success font-large-2 float-right"></i>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection
