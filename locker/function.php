<?php
$thai_day_arr=array(
  "Sun"=>"อาทิตย์",
  "Mon"=>"จันทร์",
  "Tue"=>"อังคาร",
  "Wed"=>"พุธ",
  "Thu"=>"พฤหัสบดี",
  "Fri"=>"ศุกร์",
  "Sat"=>"เสาร์"
);
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน",
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"
);
function thai_date($date){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date('D',strtotime($date))];
    $thai_date_return.= "ที่ ".date('j',strtotime($date));
    $thai_date_return.=" ".$thai_month_arr[date("n",strtotime($date))];
    $thai_date_return.= " พ.ศ.".(date('Y',strtotime($date))+543);
    return $thai_date_return;
}
 ?>
