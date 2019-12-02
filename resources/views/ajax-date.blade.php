@if(!empty($dates))
    <?Php $allData = array();?>
    @foreach($dates as $key => $value)
        <?php
        $startTime = strtotime($value->start_date);
        $endTime = date(strtotime($value->end_date));
        // $unixTimestamp1 = strtotime($value->start_date);
        // $unixTimestamp1=date('l', strtotime($value->start_date));
        // $unixTimestamp2=date('l', strtotime($value->end_date));
        //$thisDatex = array();
        for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
            $thisDate = date('l', $i);
            if ($thisDate == $value->day) {
                $thisDatex[] = date('Y-n-j', $i);

            }
        }


        $allData[] = $thisDatex;
        ?>

    @endforeach
    <?php  // $thisDatex="2019-8-21","2019-8-24","2019-7-27";

    echo json_encode($thisDatex); // print_r($allData) ;?>
@endif

