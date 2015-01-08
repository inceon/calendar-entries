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
<?php
	if(isset($_POST['date'])){
		$res = explode('.', $_POST['date']);
		$y = $res[0];
		$m = $res[1];
		$d = $res[2];
		$tm = $res[3];
		$phone = strip_tags(stripslashes(htmlspecialchars($_POST['phone'])));
		$name = strip_tags(stripslashes(htmlspecialchars($_POST['name'])));
		$sername = strip_tags(stripslashes(htmlspecialchars($_POST['sername'])));
		$other = strip_tags(stripslashes(htmlspecialchars($_POST['other'])));
		
		if (!isset($y) OR $y < 1970 OR $y > 2037) $error .= '<div class="error">Помилка в році запису</div>';
		if (!isset($m) OR $m < 1 OR $m > 12) $error .= '<div class="error">Помилка в місяці запису</div>';
		if (!isset($d) OR $d < 1 OR $d > 31) $error .= '<div class="error">Помилка в дні запису</div>';
		$res = explode(':', $tm);
		if (!isset($tm) OR $res[0] < $startDay OR $res[0] > $endDay OR ($res[1]!="30" AND $res[1]!="00")){
			$error .= '<div class="error">Помилка в часі запису</div>';
		}
		if (!preg_match("/^((8|\+38)-?)?(\(?0..\)?)?-?\d{3}-?\d{2}-?\d{2}$/", $phone))
			$error .= '<div class="error"> Не вірно введений номер телефону </div>';
		if ($name=='') $error .= '<div class="error"> Ім\'я не введено </div>';
		if ($sername=='') $error .= '<div class="error"> Прізвище не введено </div>';
		
		echo "<a href='index.php'><div id=\"logo-text\">Запис ".str_pad($d, 2, '0', STR_PAD_LEFT).".".str_pad($m, 2, '0', STR_PAD_LEFT).".$y $tm</div></a>";
		echo '<div id="calendar">';
		
		if($error!=''){
			$error .= '<a href="record.php?year='.$y.'&month='.$m.'&day='.$d.'&time='.$tm.'"><div class="error">Повернутися</div></a>';
			echo $error;
			exit();
		}else{
			echo '<div class="error" style="background-color:FFFE6E">Вдало! Запис буде розглянутий</div><br />';
			echo '<a href="day.php?year='.$y.'&month='.$m.'&day='.$d.'"><div class="error" style="background-color:FFFE6E">Повернутися</div></a>';
			$fp = fopen('data/temp.txt', 'a');
			fwrite($fp, $y.'::'.$m.'::'.$d.'::'.$tm.'::'.$name.'::'.$sername.'::'.$phone.'::'.$other."\n");
			fclose($fp);
		}
	}else{
		$y = intval($_GET['year']);
		$m = intval($_GET['month']);
		$d = intval($_GET['day']);
		$tm = $_GET['time'];
		if (!isset($y) OR $y < 1970 OR $y > 2037) $error .= '<div class="error">Помилка в році запису</div>';
		if (!isset($m) OR $m < 1 OR $m > 12) $error .= '<div class="error">Помилка в місяці запису</div>';
		if (!isset($d) OR $d < 1 OR $d > 31) $error .= '<div class="error">Помилка в дні запису</div>';
		$res = explode(':', $tm);
		if (!isset($tm) OR $res[0] < $startDay OR $res[0] > $endDay OR ($res[1]!="30" AND $res[1]!="00")){
			$error .= '<div class="error">Помилка в часі запису</div>';
		}
	
		echo "<a href='index.php'><div id=\"logo-text\">Запис ".str_pad($d, 2, '0', STR_PAD_LEFT).".".str_pad($m, 2, '0', STR_PAD_LEFT).".$y $tm</div></a>";
		echo '<div id="calendar">';
		
		if($error!=''){
			$error .= '<a href="day.php?year='.$y.'&month='.$m.'&day='.$d.'"><div class="error">Повернутися</div></a>';
			echo $error;
			exit();
		}else{
?>
			<form method="post" id="record-form" action"">
				<input type="hidden" name="date" value="<? echo $y.'.'.$m.'.'.$d.'.'.$tm ?>" />
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
<?		}
	}
		echo '</div>';
?>	
</body>	
</html>