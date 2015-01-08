<!DOCTYPE>
<html>
<head> 
<title>Календар подій</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
<script type="text/javascript" src="jquery-2.1.3.min.js"> </script>
<script type="text/javascript" src="main.js"> </script>
</head>
<body>
<?php
	$y = intval($_GET['year']);
	$m = intval($_GET['month']);
	$d = intval($_GET['day']);
	$tm = $_GET['time'];
	if (!isset($y) OR $y < 1970 OR $y > 2037) $error .= '<div class="error">Помилка в році запису</div>';
	if (!isset($m) OR $m < 1 OR $m > 12) $error .= '<div class="error">Помилка в місяці запису</div>';
	if (!isset($d) OR $d < 1 OR $d > 31) $error .= '<div class="error">Помилка в дні запису</div>';
	$res = explode(':', $tm);
	if (!isset($tm) OR $res[0] < 8 OR $res[0] > 18 OR ($res[1]!="30" AND $res[1]!="00")){
		$error .= '<div class="error">Помилка в часі запису</div>';
	}

	echo "<a href='index.php'><div id=\"logo-text\">Запис ".str_pad($d, 2, '0', STR_PAD_LEFT).".".str_pad($m, 2, '0', STR_PAD_LEFT).".$y $tm</div></a>";
	echo '<div id="calendar">';
	
	if($error!=''){
		$error .= '<a href="day.php?year='.$y.'&month='.$m.'&day='.$d.'"><div class="error">Повернутися</div></a>';
		echo $error;
		exit();
	}else{
	
		$fp = fopen('data/'.$m.'.txt', 'r');
?>
		<form method="post" id="record-form">
			Ім'я:<br />
			<input type="text" name="name" /> <br />
			Прізвище: <br />
			<input type="text" name="sername" /><br />
			Номер телефону: <br />
			<input type="text" name="phone" /><br />
			Інша інформація: <br />
			<textarea name="other"></textarea> <br />
			<input type="submit" value="Записатися">
		</form>
<?	}
	
	echo '</div>';
?>	
</body>	
</html>