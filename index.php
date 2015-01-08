<? include_once('config.php') ?>
<!DOCTYPE>
<html>
<head> 
<title>Календар подій</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
<script type="text/javascript" src="jquery-2.1.3.min.js"> </script>
<script type="text/javascript" src="main.js"> </script>
</head>
<body>
<div id="logo-text">Розпорядок записів</div>
<div id="calendar">
<?php
	include_once("days.php");
	$month = array('Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
	$year = date('Y');

	for($i = intval(date('m'));$i<=12;$i++)
		echo '<div class="month">'.$month[$i-1].', '.$year.'<div class="days">'.my_calendar($year, $i).'</div></div>';
	for($i = 1;$i<date('m');$i++)
		echo '<div class="month">'.$month[$i-1].', '.$year+1 .'<div class="days">'.my_calendar($year, $i).'</div></div>';
?>
</div>
</body>
</html>