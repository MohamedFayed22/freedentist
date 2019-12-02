
@extends('layouts.app')

<style>
    .info-box {
        display: block;
        min-height: 90px;
        background: #fff;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 2px;
        margin-bottom: 15px;
        
    }
    
    .bg-aqua {
        background-color: #00c0ef !important;
        color: #fff !important;
     }
     
     .bg-red {
      background-color: #dd4b39 !important;
      color: #fff !important;
     }
     
     .bg-green{
         background-color: #00a65a !important;
         color: #fff !important;
     }
     
     .bg-yellow{
         background-color: #f39c12 !important;
         color: #fff !important

     }
     
    .info-box-content {
        padding: 5px 10px;
        margin-left: 90px;
    }
     
    .info-box-icon {
        border-top-left-radius: 2px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 2px;
        display: block;
        float: left;
        height: 90px;
        width: 90px;
        text-align: center;
        font-size: 45px;
        line-height: 90px;
        background: rgba(0,0,0,0.2);
}

}

</style>

@section('content')

   <div class="row" style="padding:10px">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="m-menu__link-icon flaticon-layers" style="font-size: 5.3rem;margin-top:10px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Services </span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="m-menu__link-icon flaticon-share" style="font-size: 5.3rem;margin-top:10px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hospitals</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class=" m-menu__link-icon flaticon-interface-1" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dentists</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="m-menu__link-icon flaticon-calendar" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Dentist Calender</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="m-menu__item  m-menu__item--submenu" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Saudi Patients</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="m-menu__link-icon flaticon-calendar" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Offers</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="m-menu__link-icon flaticon-network" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
         <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class=" m-menu__link-icon flaticon-interface-1" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending reservation </span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
         <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class=" m-menu__link-icon flaticon-interface-1" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Upcoming reservation</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
         <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class=" m-menu__link-icon flaticon-interface-1" style="font-size: 5.3rem"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Previous reservation</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

@endsection
