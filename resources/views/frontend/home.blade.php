@extends('layouts.app')

@section('content')
<!-- Main Content-->
    <main class="main-content">
      <div class="home-back"></div>
      <!--banner section-->
      <!--modal-->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="days">
                <ul class="nav nav-pills nav-justified">
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day1">1</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day2">2</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day3">3</a></li>
                  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#day4">4</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day5">5</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day6">6</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#day7">7</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" role="tabpanel" id="day1">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="day2">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="day3">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane active" role="tabpanel" id="day4">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="day5">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="day6">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                  <div class="tab-pane" role="tabpanel" id="day7">
                    <div class="time-available"><span>8:30</span></div>
                    <div class="time-notAvailable"><span>9:30</span></div>
                    <div class="time-available"><span>10:30</span></div>
                    <div class="time-available"><span>11:30</span></div>
                    <div class="time-available"><span>12:30</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="home-content">
        <div class="container">
          <div class="bannerContent">
            <h1>كيف تعمل منصة طبيب أسنان</h1>
            <h3>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص شكل توضع الفقرات في الصفحة التي يقرأها.</h3>
          </div>
          <div class="bannerRow">
            <div class="row">
              <div class="col-md-3 padd0">
                <select class="form-control selectdd">
                  <option class="locate" selected disabled data-image="assets/imgs/home/location.svg">اختار المدينه  </option>
                  <option>مدينه 1 </option>
                  <option>مدينه 2</option>
                </select>
              </div>
              <div class="col-md-3 padd0">
                <select class="form-control selectdd">
                  <option class="locate" selected disabled data-image="assets/imgs/home/location.svg">حدد المركز الصحى</option>
                  <option>مركز 1 </option>
                  <option>مركز 2</option>
                </select>
              </div>
              <div class="col-md-3 padd0">
                <select class="form-control selectdd">
                  <option class="locate" selected disabled data-image="assets/imgs/home/doctor.svg">نوع الخدمه</option>
                  <option>خدمه 1 </option>
                  <option>خدمه 2 </option>
                </select>
              </div>
              <div class="col-md-2 padd0">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                    <div class="input-group-text"><img src="assets/imgs/home/calender.svg"></div>
                  </div>
                  <input class="form-control datetimepicker-input" type="text" data-target="#datetimepicker1" placeholder="حدد الموعد">
                </div>
              </div>
              <div class="col-md-1 padd0">
                <button class="btn-banner" data-toggle="modal" data-target="#myModal">حجز</button>
              </div>
            </div>
          </div>
          <div class="stepsRow">
            <div class="squareStart"></div>
            <div class="row">
              <div class="col-md-3">
                <div class="step step1"><img src="assets/imgs/home/location2.svg">
                  <div class="stepSquare"></div>
                  <h4>أختار المركز الطبي الأقرب</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="step step2">
                  <div class="stepSquare"></div><img src="assets/imgs/home/doctor2.svg">
                  <h4>أختار الطبيب المختص</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="step step1"><img src="assets/imgs/home/calender2.svg">
                  <div class="stepSquare"></div>
                  <h4>أختار الموعد المناسب</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="step step2">
                  <div class="stepSquare"></div><img src="assets/imgs/home/teeth.svg">
                  <h4>دمتم طيبين</h4>
                </div>
              </div>
            </div>
            <div class="squareEnd"></div>
          </div>
        </div>
      </div>
    </main>
    <!-- End Main Content-->
@endsection
