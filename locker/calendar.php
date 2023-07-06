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

    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Display inline</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd",
      minDate: 0,
      inline : true,
      altField : '#date',
      onSelect : function(){
          $('#datepick').submit();
      }
    });
  });
  </script>
    <title>Calender</title>
  </head>
  <body>
    <div class="container page-content">
      <form class="date" id='datepick' action="bookingeq.php" method="post">
        <input type="hidden" id="date" name="dateinput" value="">
    <div id="datepicker"></div>
  </form>
  </div>
  </body>
</html>
