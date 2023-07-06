<?php
session_start();
session_destroy();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="css/metro.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>Index</title>
    <style>

    </style>
  </head>
  <body bgcolor="#ff6600" onload="document.idcard.idcard.focus()">
    <div class="centerim">
      <img class="imgcard" src="images/id-card.png"></div>
      <form name="idcard" action="Menu.php" method="post">
      <input type="text" name="idcard" autocomplete="off" style="BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none; position: absolute; left: -9999px">
      </form>
    </div>
	<div style="position: absolute; top: 40%; left: 45%;">
	<div class="text" style="color:white; font-size:120%;"><h1 class="kanit">กรุณาแตะบัตรพนักงาน</h1>
	</div>
  </body>
</html>
