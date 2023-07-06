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
  </head>
  <body>
    <div class="container page-content">
      <a href="detailbookingeq.php"><img class="back" src="images/back.png"></a>
    <?php
    session_start();
    include('function.php');
    include('connects.php');
    date_default_timezone_set("Asia/Bangkok");
    $strsql="SELECT Booking.*,Equipment.EquipmentName,Equipment.Locker
    FROM NANO_Equipment.dbo.Booking,NANO_Equipment.dbo.Equipment
    WHERE Equipment.EquipmentID=Booking.EquipmentID
    AND BookingDate>= CONVERT(date,GETDATE())
    AND  Booking.BookingEMPID='".$_SESSION['empid']."'
    AND Statusobject = 'A'";
    $objquery=sqlsrv_query($conn, $strsql);
    $idl=0;
    while($objresult=sqlsrv_fetch_array($objquery)){
    if(date('Hi') >= $objresult['BookingTimeEnd'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){/*เลยเวลาคืนแล้วไม่โชว์*/}
    else if(date('Hi') >= $objresult['BookingTimeStart'] && date('Y-m-d')==date_format($objresult['BookingDate'],'Y-m-d')){}
      else{
      echo "<button class='tile-wide bg-orange' data-role='tile'>";
      $_SESSION['bid'.$idl]=$objresult['BookingID'];
      echo "<div class='img'><img src='images/eq/".$objresult['EquipmentID'].".png'></div>";
      echo "<div class='nameeq'><h3>".$objresult['EquipmentName']."</h3>
      <center><h3>".thai_date(date_format($objresult['BookingDate'],'Y-m-d'))."</h3></center>
      </div>";
      echo "<div class='timese'><h3>".substr_replace($objresult['BookingTimeStart'], ":",2,0)." น.";
      echo " - ".substr_replace($objresult['BookingTimeEnd'], ":",2,0)." น. </h3></div>";
      echo "</button>";
      echo "<br>";
    }
    }
     ?>
   </div>
  </body>
</html>
