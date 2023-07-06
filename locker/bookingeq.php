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
    <title>Booking</title>
  </head>
  <body>
    <a href="selectdate.php"><img class="back" src="images/back.png"></a>
    <form name="booking" id="booking" action="checkIDEquip.php" method="post">
     <div class="container page-content">
       <?php
	   ini_set('display_errors', 0);
       session_start();
       if($_POST['dateinput'] != ""){
       $_SESSION['year']=substr($_POST['dateinput'],0,4); echo " ";
       $_SESSION['month']=substr($_POST['dateinput'],5,2); echo " ";
       $_SESSION['day']=substr($_POST['dateinput'],8,2); echo " ";
       $_SESSION['week']=substr($_POST['dateinput'],11,3); echo " ";
       }
       $thai_day_arr=array(
         "Sun"=>"อาทิตย์",
         "Mon"=>"จันทร์",
         "Tue"=>"อังคาร",
         "Wed"=>"พุธ",
         "Thu"=>"พฤหัสบดี",
         "Fri"=>"ศุกร์",
         "Sat"=>"เสาร์"
       );
       $thai_month_arr=array(
         "0"=>"",
         "1"=>"มกราคม",
         "2"=>"กุมภาพันธ์",
         "3"=>"มีนาคม",
         "4"=>"เมษายน",
         "5"=>"พฤษภาคม",
         "6"=>"มิถุนายน",
         "7"=>"กรกฎาคม",
         "8"=>"สิงหาคม",
         "9"=>"กันยายน",
         "10"=>"ตุลาคม",
         "11"=>"พฤศจิกายน",
         "12"=>"ธันวาคม",
       );
       include('function.php');
       echo $_SESSION['dateshow']="<center><h2 class='topdate'>".thai_date($_SESSION['year']."-".$_SESSION['month']."-".$_SESSION['day'])."</h2></center>";
       include('connects.php');
       $strsql = "SELECT NANO_Equipment.dbo.Type.TypeId,NANO_Equipment.dbo.Type.TypeName
       FROM NANO_Equipment.dbo.Type
       WHERE TypeStatus='A'
       AND Type.TypeId =1
       OR Type.TypeId =2
       OR Type.TypeId =4
       order by TypeId";
       $objquery=sqlsrv_query($conn,$strsql);
       $c=1;
       while($objresult= sqlsrv_fetch_array($objquery)){
         echo "<button class='tile-wide bg-orange' id='type".$c."' onclick='posttype()'>";
         echo "<img src='images/type/".$objresult['TypeId'].".png'>";
         echo "<br><h2>".$objresult['TypeName']."</h2>";
         echo "</button>";
         $typid[$c] = $objresult['TypeId'];
         $c++;
       }
        ?>
        <script>
          $(document).ready(function() {
            $("#type1").click(function() {
              $("#valuetype").val("<?php echo $typid[1]; ?>");
              $('#booking').submit();
            });
            $("#type2").click(function() {
              $("#valuetype").val("<?php echo $typid[2]; ?>");
              $('#booking').submit();
            });
            $("#type3").click(function() {
              $("#valuetype").val("<?php echo $typid[3]; ?>");
              $('#booking').submit();
            });
          });
        </script>
     </div>
     <input type="hidden" id="valuetype" name="type" value="">
   </form>
  </body>
</html>
