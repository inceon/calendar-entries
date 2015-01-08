<!DOCTYPE>
<html>
<head> 
<title> алендарь под≥й</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
<script type="text/javascript" src="jquery-2.1.3.min.js"> </script>
<script type="text/javascript" src="main.js"> </script>
</head>
<body>
<?php
	$y = intval($_GET['year']);
	$m = intval($_GET['month']);
	$d = intval($_GET['day']);
	if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
	if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");
	if (!isset($d) OR $d < 1 OR $d > 31) $d=date("d");

	echo "<div id=\"logo-text\">$d.$m.$y</div>";
	echo '<div id="calendar">';
	
	$content = file ('data/'.$m.'.txt');
	foreach ($content as $line) { // читаем построчно
		$result = explode ('::', $line); // разбиваем строку и записываем в массив
		if($result[0]==$y && $result[1]==$d){
			echo '<div id="info"><pre>';
			print_r($result);
			echo '</pre></div>';
		}
	}
	echo '</div>';
?>	
