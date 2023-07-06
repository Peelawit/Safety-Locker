<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>NANOTEC</title>
    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
	<?php
		session_start();
		set_time_limit(10);
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors',0);

		// config
		//$ldapserver = 'nstda.or.th';
		/*$ldapserver = '10.226.202.15';
		$ldapuser      = 'NSTDA\adminnano';
		$ldappass     = 'N@n0t3c#';
		$ldaptree    = "OU=NANOTEC,DC=NSTDA,DC=OR,DC=TH";
		$card=$_POST['idcard'];
		if ($card){
		// connect
		$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");

		if($ldapconn) {
			// binding to ldap server
			$ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
			// verify binding
			if ($ldapbind) {
				//echo "LDAP bind successful...<br /><br />";
				//$card="7316FB2C";
				//echo "Matching Card UID format.";
				//$scard =  str_split($card, 2);
				//$rcard = implode(array_reverse($scard));
				//echo $scard;
				$rcard = $card;
				$card_dec = hexdec($rcard);
				//echo $rcard;

				$filter = "(extensionAttribute1=$card_dec)";
				//echo "Searching...$card<br /><br />";
				$justthese = array("samaccountname", "mail","displayname");

				$result = ldap_search($ldapconn,$ldaptree,$filter,$justthese) or die ("Error in search query: ".ldap_error($ldapconn));
				$data = ldap_get_entries($ldapconn, $result);


				// iterate over array and print data for each entry
					//echo "User: ". $data[$i]["samaccountname"][0] ."<br />";
					//echo "User: ". $data[$i]["displayname"][0] ."<br />";
					//echo "Email: ". $data[$i]["mail"][0] ."<br /><br />";
				// print number of entries found
				//echo "Number of entries found: " . ldap_count_entries($ldapconn, $result);
				$_SESSION["empid"] = $data[0]["samaccountname"][0];
				$_SESSION["empname"] = $data[0]["displayname"][0];
				$_SESSION["email"] = $data[0]["mail"][0];
			} else {
				echo "LDAP bind failed...";
			}

		}

		// all done? clean up
		ldap_close($ldapconn);
  }
		*/


		$_SESSION["empid"] = "004848";
		$_SESSION["empname"] = "Thananan Thirasatitowng";
		$_SESSION["email"] = "thananan@nanotec.or.th";

		?>
    <style>
      .img{
        position: absolute;
        top: 25%;
        left: 25%;
        width: 50%;
      }
    </style>
  </head>
  <body>
    <div class="container page-content">
      <!--<img class="back" src="images/back.png" style="display: none;">
            <div class="tile-large bg-orange" id="b1" data-role="tile">
              <img class="img" src="images/devices.png">
              อุปกรณ์ เม้นไว้ก่อนเพราะทำห้องประชุมไม่ทัน
            </div>
            <div class="tile-large bg-orange" id="b2" data-role="tile">
              <img class="img" src="images/presentation.png">
            </div>-->
            <a href="checkbooking.php"><button class="tile-large bg-orange" id="b3" data-role="tile">
              <img class="img" src="images/yerm.png">
              <h2 class="menu">จอง-รับอุปกรณ์</h2>
            </button></a>
            <form name="checkreturn" action="return.php" method="post">
              <input type="hidden" name="checkreturn" value="12">
            <button class="tile-large bg-orange" id="b4" data-role="tile">
              <img class="img" src="images/kern.png">
              <h2 class="menu margin20">คืนอุปกรณ์</h2>
            </button>
          </form>
          </div>
  </body>
</html>
