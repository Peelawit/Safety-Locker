<?php
include('connects.php');
session_start();
$_SESSION['typeid']=$_POST['type']; echo "<br/>";
/*echo $_SESSION['day']=$_POST['day']; echo "<br/>";
echo $_SESSION['month']=$_POST['month']; echo "<br/>";
echo $_SESSION['year']=$_POST['year']; echo "<br/>";*/
$strsql = "SELECT Equipment.EquipmentID,Equipment.EquipmentName
FROM NANO_Equipment.dbo.Equipment
WHERE TypeID = '".$_SESSION['typeid']."'
AND EquipmentStatus = 'A'";
$objquery = sqlsrv_query($conn, $strsql);
$i=0;
while($objresult=sqlsrv_fetch_array($objquery)){
  $_SESSION['t'.$i]= $objresult['EquipmentID'];
  $_SESSION['n'.$i]= $objresult['EquipmentName'];
  $i++;
}
$_SESSION['i']=$i;
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv= 'refresh' content='0; url=testrub.php'/>
  </head>
  <body>

  </body>
</html>
