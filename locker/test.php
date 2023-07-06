<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script>
    $(document).ready(function(){
      $.post("http://10.225.131.19/",
            {
              LOCK: "4",
            },
            function(data,status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        });
    </script>
  <body>
  </body>
</html>
