<?php

$user = `whoami`;

$ip = `ipconfig`;
$ip = substr($ip, strpos($ip, 'IPv4 Address'));
$ip = substr($ip, strpos($ip, ':')+2);
$ip = trim(substr($ip, 0, strpos($ip, ' ')));
$host = gethostbyaddr($ip);

header('Content-Type: image/png');

$im = imagegrabscreen();

$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 128, 64, 0);
$font = 3;

$strings = array('User: '.trim($user), date('Y-m-d H:i:s'), $host, $ip);
$maxwidth = 0;

foreach ($strings AS $k=>$v) {
	$size = strlen($v);
	if ($size * imagefontwidth($font) > $maxwidth) {
		$maxwidth = $size * imagefontwidth($font);
	}
}

$width = $maxwidth + 10;
$height = (imagefontheight($font) * count($strings)) + ((count($strings)-1) * 3) + 10;

imagefilledrectangle($im, 5, 5, $width, $height, $bg);

$offsetX = 10;
$offsetY = 10;

foreach ($strings AS $text) {
	imagestring($im, $font, $offsetX, $offsetY, $text, $textcolor);

	$offsetY = $offsetY + imagefontheight($font) + 3;
}

imagepng($im);
imagedestroy($im);

?>