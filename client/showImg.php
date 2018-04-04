<!DOCTYPE html>
<html>
	<head>
		<script src="jquery-3.3.1.min.js"></script>
		<script src="javascript.js"></script>
		
		<style>
			img {
				width: 95%;
			}
		</style>
	</head>

	<body>
<?php

// $src = is_set($_GET['src']) ? $_GET['src'] : 'offline.png';

echo "<center><img onerror=\"this.onerror=null;this.src='offline.png';\" src=\"http://".$_GET['src'].":8080\" alt=\"".$_GET['src']."\" /></center>";

?>
	</body>
</html>