<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include('function.php');
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Date</title>
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Display inline</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      minDate: 0,
      inline : true,
      altField : '#date',
      onSelect : function(){
          $('#datepick').submit();
      }
    });
  });
  </script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "#datepicker",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  } );
  </script>
  <style>
    .ui-datepicker .ui-widget-header{
      background: #fa6800 none;
    }
  </style>
  </head>
  <body>
    <a href="Menu.php"><img class="back" src="images/back.png"></a>
    <div class="container page-content">
      <button type="button" class="tile-wide bg-orange" id="today"><h1>วันนี้</h1><p class="description"><?php echo "(".thai_date(date('d-m-Y')).")"; ?></p></button>
      <button type="button" class="tile-wide bg-orange" id="tomorrow"><h1>
        <?php
        if(date('D',strtotime('+1 day'))=="Sat"){echo "วันจันทร์หน้า</h1><p class='description'>(".thai_date(date('d-m-Y',strtotime('+3 day'))).")";}
        elseif(date('D',strtotime('+1 day'))=="Sun"){echo "วันจันทร์หน้า</h1><p class='description'>(".thai_date(date('d-m-Y',strtotime('+2 day'))).")";}
        else{echo "พรุ่งนี้</h1><p class='description'>(".thai_date(date('d-m-Y',strtotime('+1 day'))).")";}
         ?>
       </p></button>
      <!--อันนี้คือปุ่ม มะรืนครับเผื่อจะเปิดใช้ครับ<button type="button" class="tile-wide bg-orange" id="marern"><h1><?php echo thai_date(date('d-m-Y',strtotime('+2 day'))); ?></h1></button>-->
      <a href="calendar.php"><button type="button" class="tile-wide bg-orange"><h1>เลือกวันที่</h1></button></a>
<form class="date" id='datepick' action="bookingeq.php" method="post">
  <input type="hidden" id="date" name="dateinput" value="">
  <!--<div id="datepicker"></div>-->
</form>
    </div>
    <script>
    $(document).ready(function() {
      $("#today").click(function() {
        $("#date").val("<?php echo date('Y-m-d-D'); ?>");
        $('#datepick').submit();
      });
      $("#tomorrow").click(function() {
        $("#date").val("<?php
        if(date('D',strtotime('+1 day'))=="Sat"){echo date('Y-m-d-D',strtotime('+3 day'));}
        elseif(date('D',strtotime('+1 day'))=="Sun"){echo date('Y-m-d-D',strtotime('+2 day'));}
        else{echo date('Y-m-d-D',strtotime('+1 day'));}
        ?>");
        $('#datepick').submit();
      });
      $("#marern").click(function() {
        $("#date").val("<?php echo date('Y-m-d-D',strtotime('+2 day')); ?>");
        $('#datepick').submit();
      });
    });
    </script>
  </body>
</html>
