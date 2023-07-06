<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
<title>c</title>
</head>
<body>
<?php

	ini_set('display_errors', 1);
	error_reporting(0);
   $serverName = "LT-05-0099-2\SQLEXPRESS";
   //$serverName = "10.226.203.131";
   $userName = "sa";
   //$userPassword = "N@n0t3c#";
	 $userPassword = "12345678";
   $connectionInfo = array("UID"=>$userName, "PWD"=>$userPassword,"MultipleActiveResultSets"=>true,
 "CharacterSet"  => 'UTF-8');

//Server=203.185.131.89\SQLEXPRESS;Database=NANO_MeetinfRoom;User ID=Meetingroom;Password=●●●●●●●●
  $conn = sqlsrv_connect( $serverName,$connectionInfo);

	/*if($conn)
	{
		echo "Database Connected.";
	}
	else
	{
		die( print_r( sqlsrv_errors(), true));
	}
	$strsql ="SELECT Equipment.EquipmentID,Equipment.EquipmentName,Booking.EquipmentID
	from Equipment,Booking
	where Equipment.EquipmentID = '18' and Equipment.EquipmentID = Booking.EquipmentID";
	/*$strsql ="SELECT TOP 10* FROM Booking";
	$query = sqlsrv_query($conn, $strsql);
echo "<table align='center' border='1'>";
echo "<tr align='center' bgcolor='#88bd33'></tr>";
while ($objresult = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
echo "<td>".$objresult['BookingID']."</td>";
echo "<td>".date_format($objresult['BookingDate'],'Y-m-d')."</td>";
echo "<td>".$objresult['BookingTimeStart']."</td>";
echo "<td>".$objresult['BookingTimeEnd']."</td>";
echo "<td>".$objresult['BookingDetail']."</td>";
echo "<td>".$objresult['BookingStatus']."</td>";
echo "<td>".$objresult['BookingEMPID']."</td>";
echo "<td>".$objresult['EquipmentID']."</td>";
echo "<td>".date_format($objresult['CreateDate'],'Y-m-d')."</td>";
echo "<td>".$objresult['CreateBy']."</td>";
echo "<td>".date_format($objresult['UpdateDate'],'Y-m-d')."</td>";
echo "<td>".$objresult['UpdateBy']."</td>";
echo "</tr>";
}
echo "</table>";*/
	//sqlsrv_close($conn);
?>
</body>
</html>
