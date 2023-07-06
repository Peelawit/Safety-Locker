<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
//$_SESSION['empid']='005089';
include('connects.php');
/**
session_start();
echo $_SESSION['bid'];
if($_SESSION['bid'] != NULL){
	include('connects.php');
	$strsql = "UPDATE NANO_Equipment.dbo.Booking set Statusobject ='B'
	WHERE BookingID = '".$_SESSION['bid0']."'";
	$objquery=sqlsrv_query($conn, $strsql);
	unset($_SESSION['bid']);
} **/
?>
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
    <title></title>
	<script type="text/javascript">
		function myFunction(LockID,BookingID) {
			//alert(LockID);
			//alert(BookingID);
			$('#LOCK').val(LockID);
			$('#BookingID').val(BookingID);
			$.post( "update_status.php", { BookingID: $("#BookingID").val(), Status: 'B'  } );
			document.getElementById("formPost").submit();
			setTimeout(function () {
				location.reload();
			}, 1000);
		}

	</script>
	<script type="text/javascript">
		function countdown() {
			var i = document.getElementById('counter');
			if (parseInt(i.innerHTML)==1) {
				location.href = 'menu.php';
			}
			i.innerHTML = parseInt(i.innerHTML)-1;
		}
		setInterval(function(){ countdown(); },1000);
	</script>
  </head>
  <body>
    <div class="container page-content">
      <a href="Menu.php"><img class="back" src="images/back.png"></a>
    <?php
	$strCount="SELECT Booking.*,Equipment.EquipmentName,Equipment.Locker
    FROM NANO_Equipment.dbo.Booking,NANO_Equipment.dbo.Equipment
    WHERE Equipment.EquipmentID=Booking.EquipmentID
    AND BookingDate >= CONVERT(date,GETDATE())
	AND [NANO_Equipment].[dbo].[Booking].[BookingTimeStart] <= '".date('Hi',strtotime('+30 minute'))."'
    AND Booking.BookingEMPID='".$_SESSION['empid']."'
    AND Statusobject = 'A'";
    $objquery= sqlsrv_query($conn, $strCount);
    $i=0;
    $countrub = 0;
    while($objresult=sqlsrv_fetch_array($objquery)){
    if(date('Hi') >= $objresult['BookingTimeEnd'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){/*เลยเวลาคืนไม่นับ*/}
  else if(date('Hi',strtotime('+30 minute')) >= $objresult['BookingTimeStart'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){/*นับจำนวนของที่รับได้*/
    $countrub++;
  }
    }
	$objQueryCount = sqlsrv_query($conn, $strCount, array(), array( "Scrollable" => 'static' ));
	$rowCount = sqlsrv_num_rows($objQueryCount);
	if($countrub != 0){
		echo "<br/><center><h2> อุปกรณ์ที่จอง : ".$countrub." ชิ้น</h2></center>";
	}

    $strsql="SELECT Booking.*,Equipment.EquipmentName,Equipment.Locker
    FROM NANO_Equipment.dbo.Booking,NANO_Equipment.dbo.Equipment
    WHERE Equipment.EquipmentID=Booking.EquipmentID
    AND BookingDate>= CONVERT(date,GETDATE())
    AND  Booking.BookingEMPID='".$_SESSION['empid']."'
    AND Statusobject = 'A'";
    $objquery=sqlsrv_query($conn, $strsql);
    while($objresult=sqlsrv_fetch_array($objquery)){
    if(date('Hi') >= $objresult['BookingTimeEnd'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){/*เลยเวลาคืนแล้วไม่โชว์*/}
    else if(date('Hi',strtotime('+30 minute')) >= $objresult['BookingTimeStart'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){
      $LockID = $objresult['Locker'];
	  $BookingID = $objresult['BookingID'];
	  switch($LockID){
		case "1":
			$OpenID = "AAA";
		break;
		case "2":
			$OpenID = "BBB";
		break;
		case "3":
			$OpenID = "CCC";
		break;
		case "4":
			$OpenID = "DDD";
		break;
		case "5":
			$OpenID = "EEE";
		break;
		case "6":
			$OpenID = "FFF";
		break;
		}
	  echo "<div class='tile-wide bg-orange' data-role='tile' onclick=\"myFunction('".$OpenID."','".$BookingID."')\">";
      $_SESSION['bid']=$objresult['BookingID'];
      echo "<div class='img'><img src='images/eq/".$objresult['EquipmentID'].".png'></div>";
      echo "<div class='nameeq'><center><h3>ตู้ที่ ".$LockID."</h3></center><h3>".$objresult['EquipmentName']."</h3></div>";
      echo "<div class='timese'>".substr_replace($objresult['BookingTimeStart'], ".",2,0);
      echo " - ".substr_replace($objresult['BookingTimeEnd'], ".",2,0)." น. </div>";
      //echo "ตู้ที่".$_SESSION['lock'.$objresult['Locker']]=$lock[$objresult['Locker']]=$objresult['Locker'];
      echo "</div>";
      echo "<br>";
    }else{
        $i++;
      /*echo "ยังไม่ถึงเวลารับ".$objresult['BookingID']."||";
      echo $objresult['BookingTimeStart']."||";
      echo $objresult['BookingTimeEnd']."||";
      echo $objresult['EquipmentID']."||";
      echo $objresult['Locker'];
      echo "<br>";*/
    }
    }
    if($countrub==0 && $i !=0 ){
      echo "<a href='selectdate.php'><button id='b1' class='tile-wide bg-orange'><h1>จองอุปกรณ์เพิ่ม</h1></button></a>";
      echo "<a href='showlistbooking.php'><button class='tile-wide bg-orange'><h1>ดูรายการจอง</h1></button></a>";
    }
    elseif($i==0 && $countrub==0){
  		echo "<br/><center><h2>รับอุปกรณ์ครบเรียบร้อยแล้ว </h2></center>";
  		echo "<div class='tile-wide bg-orange' data-role='tile' style='color:#fff;'><center><h1>You will be Logout in <span id='counter'>6</span> second(s).</p></h1></center></div>";
  		echo "<script type='text/javascript'>countdown()</script>";
  	}
	?>
	 <form action="http://10.225.131.19" id="formPost" method="POST">
		<input type="text" id="LOCK" name="LOCK" value="" hidden="hidden">
	</form>
	<input type="text" id="BookingID" name="BookingID" value="" hidden="hidden">
   </div>
  </body>
</html>
