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
    <title></title>
    <script>
  		function myFunction(LockID,BookingID,ReturnBy) {
  			//alert(LockID);
  			//alert(BookingID);
  			$('#LOCK').val(LockID);
  			$('#BookingID').val(BookingID);
        $('#ReturnBy').val(ReturnBy);
  			$.post( "update_status.php", { BookingID: $("#BookingID").val(), Status: 'C', ReturnBy: $("#ReturnBy").val() } );
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
    include('connects.php');
    session_start();
    $strsql = "SELECT Booking.*,Equipment.EquipmentName,Equipment.Locker
    FROM NANO_Equipment.dbo.Booking,NANO_Equipment.dbo.Equipment
    WHERE Equipment.EquipmentID=Booking.EquipmentID
    AND Statusobject = 'B'";
    $objquery = sqlsrv_query($conn, $strsql);
    $ReturnBy = $_SESSION['empid'];
    while($objresult=sqlsrv_fetch_array($objquery)){
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
      echo "<div class='tile-wide bg-orange' data-role='tile' onclick=\"myFunction('".$OpenID."','".$BookingID."','".$ReturnBy."')\">";
        $_SESSION['bid']=$objresult['BookingID'];
        echo "<div class='img'><img src='images/eq/".$objresult['EquipmentID'].".png'></div>";
        echo "<div class='nameeq'><center><h3>ตู้ที่ ".$LockID."</h3></center><h3>".$objresult['EquipmentName']."</h3></div>";
        echo "<div class='timese'>".substr_replace($objresult['BookingTimeStart'], ".",2,0);
        echo " - ".substr_replace($objresult['BookingTimeEnd'], ".",2,0)." น. </div>";
        //echo "ตู้ที่".$_SESSION['lock'.$objresult['Locker']]=$lock[$objresult['Locker']]=$objresult['Locker'];
        echo "</div>";
        echo "<br>";
    }
    if($BookingID == ""){
    echo "<br/><center><h2>คืนอุปกรณ์ครบเรียบร้อยแล้ว</h2></center>";
    echo "<div class='tile-wide bg-orange' data-role='tile' style='color:#fff;'><center><h1>You will be Logout in <span id='counter'>6</span> second(s).</p></h1></center></div>";
    echo "<script type='text/javascript'>countdown()</script>";
  }
     ?>
     <form action="http://10.225.131.19" id="formPost" method="POST">
  		<input type="text" id="LOCK" name="LOCK" value="" hidden="hidden">
    </form>
    <input type="text" id="BookingID" name="BookingID" value="" hidden="hidden">
    <input type="text" id="ReturnBy" name="ReturnBy" value="" hidden="hidden">
   </div>
  </body>
</html>
