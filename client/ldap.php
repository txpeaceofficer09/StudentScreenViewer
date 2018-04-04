<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="ldap.css" />
	</head>
	<body>
<?php

$ldap_host = 'dc2.kcisd.local';
$ldap_user = 'kcisd\username';
$ldap_pass = 'password';

$ds = ldap_connect($ldap_host);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
$bd = ldap_bind($ds, $ldap_user, $ldap_pass);
$dn = "OU=Campuses,DC=kcisd,DC=local";

function getOUs($ds, $dn) {
	$filter = array('BYOD', 'Administration', 'Groups', 'Servers', 'Users', 'Former Employees', 'PrinterGroups', 'Technology', 'trans', 'teacher', 'Boys Coachs', 'Girls Coachs', 'test', 'Teacher', 'Kitchen', 'Office', 'CEC');

	$result = ldap_list($ds, $dn, "ou=*", array("ou"));
	$entries = ldap_get_entries($ds, $result);
	if ($entries["count"] > 0) {
		echo "<ul>";
		for ($i=0; $i < $entries["count"]; $i++) {
			if (!in_array($entries[$i]["ou"][0], $filter)) {
				echo "<li><a target=\"right\" href=\"screens.php?dn=".urlencode($entries[$i]["dn"])."\">".$entries[$i]["ou"][0]."</a>";
				getOUs($ds, $entries[$i]["dn"]);
				echo "</li>";
			}
		}
		echo "</ul>";
	}
}

getOUs($ds, $dn);

ldap_unbind($ds);

?>
	</body>
</html>