<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
    <title>Select Time</title>
  </head>
  <body>
    <div class="container page-content">
      <a href="testrub.php"><img class="back" src="images/back.png"></a>
      <?php
      session_start();
      echo $_SESSION['dateshow'];
      $_SESSION['eqid']=$_POST['eqid'];
      include('connects.php');
      $strsql="SELECT booking.*
      FROM NANO_Equipment.dbo.booking
      WHERE EquipmentID = '".$_SESSION['eqid']."'
      AND BookingDate= '".$_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day']."'";
      $objquery = sqlsrv_query($conn, $strsql);
      $itime = 0;
      $times = array("0700","0730","0800","0830","0900","0930","1000","1030","1100","1130","1200"
      ,"1230","1300","1330","1400","1430","1500","1530","1600","1630","1700","1730","1800","1830","1900","1930","2000");
      $timesLine = array();
      while($objresult=sqlsrv_fetch_array($objquery)){
        if($objresult['Statusobject']=="C"){}
        else{
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
        		$timesLine[$i]=$arrPush;
        			while($timeEnd != $times[$i]) {
        				$timesLine[$i]=$arrPush;
        				$i++;
        			}$i = $i-1;
        	}else{
            if($timesLine[$i]==0){$timesLine[$i] = 0;}
            else{}
        	}
        }
      }
      }//ปิด while
      $timeStartFree = array();
      $timeEndFree = array();
      $icou = 0;
      for($i=0;$i<=26;$i++){
          if($timesLine[$i] == 0){
          $timeStartFree[]=$times[$i];
          while($timesLine[$i] <= 0 AND $i <= 26){
            if($i < 25){
              $timeEnd = $times[$i+1];
            }
            else{
              $timeEnd = $times[$i];
            }
            $i++;
          }
          $timeEndFree[]=$timeEnd;
          $icou++;
        }
      }
      $emptyt = 0;
      for($i=0;$i<$icou;$i++) {
      if(date('dmY')==$_SESSION['checkdate']){
        if($timeStartFree[$i] < date('Hi')){
          $timeStartFree[$i]=date('H')."00";
          if(date('i')>="30"){$timeStartFree[$i]=date('H')."30";}
      }
    }
          $m = $timeEndFree[$i]-$timeStartFree[$i];
          if($m<200){$timeStartFree[$i]="";$timeEndFree[$i]="";}
          elseif($timeStartFree[$i] >= 1700){$timeStartFree[$i]="";$timeEndFree[$i]="";}
        if($timeStartFree[$i] == ""){}
          elseif($timeStartFree[$i]<="1000" && $timeEndFree[$i]=="2000"){
            echo "<button name='b2' id='bmorning' class='tile-wide bg-orange'><h1>ช่วงเช้า</h1></button>";
            echo "<button name='b2' id='bafternoon' class='tile-wide bg-orange'><h1>ช่วงบ่าย</h1></button>";
            echo "<button name='b2' id='ballday' class='tile-wide bg-orange'><h1>ทั้งวัน</h1></button>";
            $emptyt++;
          }
          else{
          echo "<button name='b2' id='b".$i."' class='tile-wide bg-orange'>";
          echo "<h1 class='textinbox'>".substr_replace($timeStartFree[$i],":",2,0)."น. - ".substr_replace($timeEndFree[$i],":",2,0)."น.</h1><br/></button>";
          $emptyt++;
        }
      }
      /*if($emptyt==0){
        echo "<div class='tile-wide bg-orange'>
          <center><h2>ไม่มีของเลยจ้า</h2></center>
        </div>";
      }*/
       ?>
    </div>
    <form name='time' id="ftime" action="addBooking.php" method="post">
      <input type="hidden" name="time" id="time">
    </form>
    <script>
      $(document).ready(function() {
        $('#bmorning').click(function(){
          $('#time').val('07001200');
          $('#ftime').submit();
        });
        $('#bafternoon').click(function(){
          $('#time').val('13001700');
          $('#ftime').submit();
        });
        $('#ballday').click(function(){
          $('#time').val('07001700');
          $('#ftime').submit();
        });
        <?php
        for($i=0;$i<=$icou;$i++){
        echo "$('#b".$i."').click(function(){
          $('#time').val('".$timeStartFree[$i].$timeEndFree[$i]."');
          $('#ftime').submit();
        });";
      }
        ?>
        //$('#ftime').submit();
      });
    </script>
  </body>
</html>
