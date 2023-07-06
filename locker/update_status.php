<?php
session_start();
include('connects.php');
if($_POST['ReturnBy'] != ""){
  $strsql = "UPDATE NANO_Equipment.dbo.Booking set Statusobject ='".$_POST['Status']."',ReturnBy = '".$_POST['ReturnBy']."'
  WHERE BookingID = '".$_POST['BookingID']."'";
  $objquery=sqlsrv_query($conn, $strsql);
}else{
$strsql = "UPDATE NANO_Equipment.dbo.Booking set Statusobject ='".$_POST['Status']."'
WHERE BookingID = '".$_POST['BookingID']."'";
$objquery=sqlsrv_query($conn, $strsql);
}
?>
