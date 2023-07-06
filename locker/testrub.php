<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>bookingshowtime</title>

    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <a href="bookingeq.php"><img class="back" src="images/back.png"></a>
    <div class="container page-content">
<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
echo $_SESSION['dateshow'];
include('connects.php');
$strsql = "SELECT Equipment.EquipmentID,Equipment.EquipmentName,Booking.BookingTimeStart,Booking.BookingTimeEnd,Booking.Statusobject
FROM NANO_Equipment.dbo.Equipment,NANO_Equipment.dbo.Booking
WHERE TypeID= '".$_SESSION['typeid']."'
AND BookingDate= '".$_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day']."'
AND EquipmentStatus = 'A'
AND Booking.EquipmentID = Equipment.EquipmentID";
$objquery = sqlsrv_query($conn, $strsql);
$itime = 0;
$checkrecord[]=0;
$times = array("0700","0730","0800","0830","0900","0930","1000","1030","1100","1130","1200"
,"1230","1300","1330","1400","1430","1500","1530","1600","1630","1700","1730","1800","1830","1900","1930","2000");
$timesLine = array();
while($objresult=sqlsrv_fetch_array($objquery)){
  if($objresult['Statusobject']=="C"){}
  else{
  $EquipmentID[$itime] = $objresult['EquipmentID'];
  $EquipmentName[$itime] = $objresult['EquipmentName'];
  if($objresult['BookingTimeStart']=="0700"){$timeStart=$objresult['BookingTimeStart'];}else{
  $timeStart=date('Hi',strtotime($objresult['BookingTimeStart'].'- 30 minute'));
}
  if($objresult['BookingTimeEnd']=="2000"){$timeEnd=$objresult['BookingTimeEnd'];}else{
  $timeEnd=date('Hi',strtotime($objresult['BookingTimeEnd'].'+ 30 minute'));
}
  $arrPush = 0;
  for($i=0;$i<=26;$i++){
      if($timeStart == $times[$i]){
  		$arrPush = 1;
  		$timesLine[$EquipmentID[$itime]][$i]=$arrPush;
  			while($timeEnd != $times[$i]) {
  				$timesLine[$EquipmentID[$itime]][$i]=$arrPush;
  				$i++;
  			}$i = $i-1;
  	}else{
      if($timesLine[$EquipmentID[$itime]][$i]==0){$timesLine[$EquipmentID[$itime]][$i] = 0;}
      else{}
  	}
  }
$itime++;
for($i=0;$i<$_SESSION['i'];$i++){
  if($_SESSION['t'.$i]==$objresult['EquipmentID']){$checkrecord[$_SESSION['t'.$i]]++;}else{}
}
}
}
//ปิด while
//ถ้า itime มีค่ามากกว่า 1 ก็ให้ตรวจเช็ค EquipmentID[$i]==EquipmentID[$i+1] แบบนี้เช็คได้แน่นอล
$timeStartFree = array();
$timeEndFree = array();
$icou = array();
for($i1=0;$i1<2;$i1++){
/*for($i=0;$i<=26;$i++){
  echo $timesLine[$EquipmentID[$i1]][$i]."--".$times[$i]."<br/>"; อย่าลืมเปิด เป็นตัวเทียบ 0 1 กับเวลา
}echo "<br>";*/
for($i=0;$i<=26;$i++){
    if($timesLine[$_SESSION['t'.$i1]][$i] == 0){
    $timeStartFree[$_SESSION['t'.$i1]][]=$times[$i];
    while($timesLine[$_SESSION['t'.$i1]][$i] <= 0 AND $i <= 26){
      if($i < 25){
        $timeEnd = $times[$i+1];
      }
      else{
        $timeEnd = $times[$i];
      }
      $i++;
    }
    $timeEndFree[$_SESSION['t'.$i1]][]=$timeEnd;
    $icou[$i1]++;
  }
}
}
for($i=0;$i<$_SESSION['i'];$i++){
//echo "<button type='button' name='b2' id='b".$_SESSION['t'.$i]."' class='tile-wide bg-orange' data-toggle='modal' data-target='#Modal".$_SESSION['t'.$i]."'><img src='images/eq/".$_SESSION['t'.$i].".PNG'><br/><h4 id='h".$_SESSION['t'.$i]."'>".$_SESSION['n'.$i]."</h4><br/>";
$i1=0;
$emptyt[$_SESSION['t'.$i]] = 0;
$_SESSION['checkdate'] = $_SESSION['day'].$_SESSION['month'].$_SESSION['year'];
for($i1=0;$i1<$icou[$i];$i1++) {
  if(date('dmY')==$_SESSION['checkdate']){
    if($timeStartFree[$_SESSION['t'.$i]][$i1] < date('Hi')){
      $timeStartFree[$_SESSION['t'.$i]][$i1]=date('H')."00";
      if(date('i')>="30"){$timeStartFree[$i]=date('H')."30";}
  }
}
    $m = $timeEndFree[$_SESSION['t'.$i]][$i1]-$timeStartFree[$_SESSION['t'.$i]][$i1];
    if($m<200){$timeStartFree[$_SESSION['t'.$i]][$i1]="";$timeEndFree[$_SESSION['t'.$i]][$i1]="";}
    elseif($timeStartFree[$_SESSION['t'.$i]][$i1] >= 1700){$timeStartFree[$_SESSION['t'.$i]][$i1]="";$timeEndFree[$_SESSION['t'.$i]][$i]="";}
  if($timeStartFree[$_SESSION['t'.$i]][$i1] == ""){}else{
    echo "<button type='button' name='b2' id='b".$_SESSION['t'.$i]."' class='tile-wide bg-orange'><img src='images/eq/".$_SESSION['t'.$i].".PNG'><br/><h2>".$_SESSION['n'.$i]."</h2><br/></button>";
    $timeStartFree[$_SESSION['t'.$i]][$i1]."น. - ".$timeEndFree[$_SESSION['t'.$i]][$i1]."น.<br/>";
    $emptyt[$i]++;
  }
}
      if($emptyt[$i]==0){
        echo "<button class='tile-wide bg-orange'>
          <center><img src='images/eq/".$_SESSION['t'.$i].".PNG'><h2>ไม่มีอุปกรณ์ที่ว่างอยู่</h2></center>
        </button>";
      }
}
$i=$i-1;
$i1=$i1-1;
$timestartAll=$timeStartFree[$_SESSION['t'.$i]][$i1];
$timeendAll=$timeEndFree[$_SESSION['t'.$i]][$i1];

?>

<!-- Modal -->
<?php
for($i=0;$i<$_SESSION['i'];$i++){

  if($checkrecord[$_SESSION['t'.$i]]>0){

    /*
echo "<div class='modal fade' id='Modal".$_SESSION['t'.$i]."' role='dialog'>
  <div class='modal-dialog'>

    <div class='modal-content'>
      <div class='modal-header'>

        <h4 class='modal-title'>เลือกช่วงเวลาที่จะจอง</h4>
      </div>
      <div class='modal-body'>";
      if($timestartAll=="0700" && $timeendAll=="2000"){
        echo "<button id='dfm".$_SESSION['t'.$i]."' class='btn btn-default' name='button'>ช่วงเช้า</button>";
        echo "<button id='dfa".$_SESSION['t'.$i]."' class='btn btn-default' name='button'>ช่วงบ่าย</button>";
        echo "<button id='dfad".$_SESSION['t'.$i]."' class='btn btn-default' name='button'>ทั้งวัน</button>";
      }else{
        for($i1=0;$i1<$icou[$i];$i1++){
          if($timeStartFree[$_SESSION['t'.$i]][$i1] == ""){}else{
        echo "
        <button id='w".$_SESSION['t'.$i].$i1."' class='btn btn-default' name='button'>".$timeStartFree[$_SESSION['t'.$i]][$i1]."น. - ".$timeEndFree[$_SESSION['t'.$i]][$i1]."น.</button>";
      }
      }
    }
        echo"
      </div>
      <div class='modal-footer'>
      <input type='submit' id='submit".$_SESSION['t'.$i]."' name='submit' value='Submit'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>";
*/
}else{/*echo "GG";*/}
}
?>
<form name='data' id='booking' action='timebooking.php' method='post'>
  <input class="test" id="time" type="hidden" name="time" value="">
  <input class="test" id="eqid" type="hidden" name="eqid" value="">
  <input class="test" id="detail" type="hidden" name="detail" value="">
  <!--<input type="submit" id="submit" name="submit" value="Submit">-->
</form>
<script>
  $(document).ready(function(){
    <?php
    for($i=0;$i<$_SESSION['i'];$i++){
      echo "$('#b".$_SESSION['t'.$i]."').click(function(){
        $('#eqid').val('".$_SESSION['t'.$i]."');
        $('#booking').submit();
      });";
      echo "$('#dfm".$_SESSION['t'.$i]."').click(function(){
        $('#time').val('07001200');
      });
      $('#dfa".$_SESSION['t'.$i]."').click(function(){
        $('#time').val('13001700');
      });
      $('#dfad".$_SESSION['t'.$i]."').click(function(){
        $('#time').val('07001700');
      });";
    for($i1=0;$i1<$icou[$i];$i1++){
    echo "$('#w".$_SESSION['t'.$i].$i1."').click(function(){
      $('#time').val('".$timeStartFree[$_SESSION['t'.$i]][$i1].$timeEndFree[$_SESSION['t'.$i]][$i1]."');
      $('#submit').fadeIn();
    });";
  }
}
    ?>
  });
</script>
</div>
 </body>
</html>
