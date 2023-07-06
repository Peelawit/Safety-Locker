<?php
session_start();
$date=date('Y-m-d');
$bookingdate=$_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day'];
include('connects.php');
$strsql = "INSERT INTO NANO_Equipment.dbo.Booking VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params=array($bookingdate,substr($_POST['time'],0,4),substr($_POST['time'],4,8),"จองอุปกรณ์จากตู้","A",$_SESSION['empid'],$_SESSION['eqid'],
$date,$_SESSION['empid'],$_SESSION['empid'],$date,"A",NULL);
$objquery=sqlsrv_query($conn, $strsql, $params);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv= 'refresh' content='3; url=Menu.php'/>
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
      <button class="tile-wide bg-orange">
        <center><h2>จองอุปกรณ์เรียบร้อย</h2></center>
      </button>
    </div>
  </body>
</html>
