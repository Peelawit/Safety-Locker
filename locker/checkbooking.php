<?php
include('connects.php');
session_start();
/*ตำสั่ง sql ที่จะเช็คว่าidcard ใบนี้เป็นของใคร รหัสพนักงานเขาคืออะไรแล้วเอาไปเช็คว่ามีรายการจองตั้งแต่วันนี้ไปจนอนาคตหรือไม่
ถ้ามีก็ให้ถ้าเช็ค if ข้างล่างอีกว่ามีรหัสพนักงานออกมาไหม ถ้าไม่มีก็ให้ไปหน้าจอง แต่ถ้ามีก็ให้ไปหน้ารับ*/
$strsql="SELECT Booking.*
FROM NANO_Equipment.dbo.Booking
WHERE BookingEMPID = '".$_SESSION['empid']."'
AND BookingDate >= CONVERT(date,getdate())
AND Statusobject = 'A'";
$objquery=sqlsrv_query($conn,$strsql);
while($objresult=sqlsrv_fetch_array($objquery, SQLSRV_FETCH_ASSOC)){
  $empid=$objresult['BookingEMPID'];
}

//echo date('Y-m-d',strtotime('+3 weeks'))."</br>"; เหมือนว่าจะต้องเอาไว้ใช้เรื่องการเดาวันอะไรงี้ มาเปิดด้วยนะถ้าได้ใช้
//echo date('Y-m-d',strtotime('now')); เปิดด้วยยยยยยยยย
 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php
    if(!$empid){
    echo "<meta http-equiv= 'refresh' content='0; url=selectdate.php'/>";
  }else{
    echo "<meta http-equiv= 'refresh' content='0; url=detailbookingeq.php'/>";
  }
  ?>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
