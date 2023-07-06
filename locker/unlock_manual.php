<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<style>
	*{
		font-family: 'Encode Sans Semi Condensed';
	}
	table, th, td {
		border: 1px solid #CCC;
		border-spacing: 0;
		text-align: center;
	}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Semi+Condensed" rel="stylesheet">
	<script>
	
	function updateColors(tdName) {
		var name = tdName;
		$("#" + name).css("background-color", "green");
		$("#" + name).css("color", "white");
	}

	function openLocker() {
		document.getElementById("formPost").submit();
		updateColors(document.getElementById("dropdown").value);
			setTimeout(function () {
				location.reload();
			}, 1000);
		}
		
	var numID = ["AAA", "BBB", "CCC","DDD", "EEE", "FFF"];
	var B = 5; //max size of 'cache'
	var N = 0;

	var chooseName = function () {
		var unique = true;
		var num = Math.floor(Math.random() * numID.length - N);
		N = Math.min(N + 1, B);
		var name = numID.splice(num,1);
		return name;
	}

	var i = 1;
	function UnlockAllLocker () {
	   setTimeout(function () {
		  //var numID = ["AAA", "BBB", "CCC","DDD", "EEE", "FFF"];
		  document.getElementById("LOCK").value = chooseName();
		  updateColors(document.getElementById("LOCK").value);
		  document.getElementById("UnlockAll").submit();
		  i++;
		  if (i <= 6) {
			UnlockAllLocker();
		  }else{
			setTimeout(function () { location.reload(1); }, 3000);
		  }    
	   }, 3000)
	}
	</script>
  </head>
	<form action="http://10.225.131.19/" id="formPost" method="POST">
	  Locker ID :
	   <select name="LOCK" id="dropdown">
		  <option value="AAA">Number 1</option>
		  <option value="BBB">Number 2</option>
		  <option value="CCC">Number 3</option>
		  <option value="DDD">Number 4</option>
		  <option value="EEE">Number 5</option>
		  <option value="FFF">Number 6</option>
		</select>
	  <input type="button" onclick="openLocker()" value="Unlock">
	   <input type="button" onclick="UnlockAllLocker()" value="Random Unlock">
	</form>
	<br/>
	<form action="http://10.225.131.19/" id="UnlockAll" method="POST">
	  <input type="text" id="LOCK" name="LOCK" value="" readonly="readonly" hidden="hidden">
	</form>
  <body>
  <table border="0" width="30%">
  <tr>
	<td colspan="6" style="color:white;background-color:#ccc;">Status</td>
  </tr>
  <tr>
    <td id="AAA">1</td>
    <td id="BBB">2</td>
    <td id="CCC">3</td>
	<td id="DDD">4</td>
    <td id="EEE">5</td> 
    <td id="FFF">6</td>
  </tr>
</table>
  </body>
</html>