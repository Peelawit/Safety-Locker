 <!DOCTYPE html>
 <html>
   <head>
     <link href="css/metro-responsive.css?v=1001" rel="stylesheet">
     <meta charset="utf-8">
     <title></title>
   </head>
   <body bgcolor="#ff6600">
		<?php
		session_start();
		set_time_limit(10);
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors',0);

		// config
		$ldapserver = '';
		$ldapuser      = '';
		$ldappass     = '';
		$ldaptree    = "";
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
				echo $rcard;

				$filter = "(extensionAttribute1=$card_dec)";
				//echo "Searching...$card<br /><br />";
				$justthese = array("samaccountname", "mail","displayname");

				$result = ldap_search($ldapconn,$ldaptree,$filter,$justthese) or die ("Error in search query: ".ldap_error($ldapconn));
				$data = ldap_get_entries($ldapconn, $result);

				// SHOW ALL DATA
		/*        echo '<h1>Dump all data</h1><pre>';
				print_r($data);
				echo '</pre>';
		*/
				// iterate over array and print data for each entry
					//echo "User: ". $data[$i]["samaccountname"][0] ."<br />";
					//echo "User: ". $data[$i]["displayname"][0] ."<br />";
					//echo "Email: ". $data[$i]["mail"][0] ."<br /><br />";
				// print number of entries found
				//echo "Number of entries found: " . ldap_count_entries($ldapconn, $result);
				echo $_SESSION["empid"] = $data[0]["samaccountname"][0];
			} else {
				echo "LDAP bind failed...";
			}

		}

		// all done? clean up
		ldap_close($ldapconn);
		}
		?>
      <div class="loader"></div>
   </body>
 </html>
