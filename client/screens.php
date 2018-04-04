<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css" />

<script src="jquery-3.3.1.min.js"></script>
<script src="javascript.js"></script>
</head>

<body>
<?php

// echo "<center><h2>".urldecode($_GET['dn'])."</h2></center>";

function isComputer($arr) {
	$retVal = false;

	if (in_array('computer', $arr)) $retVal = true;

	return $retVal;
}

$screens = array();

$ldap_host = 'dc2.kcisd.local';
$ldap_user = 'kcisd\username';
$ldap_pass = 'password';

$ds = ldap_connect($ldap_host);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
$bd = ldap_bind($ds, $ldap_user, $ldap_pass);
$dn = isset($_GET['dn']) ? urldecode($_GET['dn']) : 'OU=Campuses,DC=kcisd,DC=local';

$result = ldap_list($ds, $dn, "samaccountname=*", array('objectclass', 'cn'));
$entries = ldap_get_entries($ds, $result);
for ($i=0; $i < $entries["count"]; $i++) {
	// echo $entries[$i]["ou"][0];
	// print_r($entries[$i]);

	if (isComputer($entries[$i]['objectclass'])) {
		array_push($screens, $entries[$i]["cn"][0]);
	}
}

ldap_unbind($ds);

sort($screens);

foreach ($screens AS $id=>$screen) {
	if ($fp=fsockopen($screen, 8080, $errno, $errstr, 0.05)) {
		echo "<div><a href=\"showImg.php?src=".$screen."\"><img id=\"img".$id."\" src=\"http://".$screen.":8080\" alt=\"".$screen."\" /></a><span>".$screen."</span></div>\r\n";
		fclose($fp);
	} else {
		echo "<div><a href=\"showImg.php?src=".$screen."\"><img src=\"offline.png\" alt=\"".$screen."\" /></a><span>".$screen."</span></div>\r\n";
	}
}

if (count($screens) == 0) {
	echo "<center><h3>No computers in this OU.</h3></center>";
}

?>
</body>
</html>
