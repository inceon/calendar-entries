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
	$y = intval($_GET['year']);
	$m = intval($_GET['month']);
	$d = intval($_GET['day']);
	if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
	if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");
	if (!isset($d) OR $d < 1 OR $d > 31) $d=date("d");

	echo "<a href='index.php'><div id=\"logo-text\">".str_pad($d, 2, '0', STR_PAD_LEFT).".".str_pad($m, 2, '0', STR_PAD_LEFT).".$y</div></a>";
	echo '<div id="calendar">';
	
	$content = file ('data/'.$m.'.txt');
	
	for($i=$startDay;$i<=$endDay;$i++){
		foreach ($content as $line) { 
			$result = explode ('::', $line); 
			if($result[0]==$y && $result[1]==$d && $result[2]==$i.':00'){
				$entrys[0] = $result;
			}
			if($result[0]==$y && $result[1]==$d && $result[2]==$i.':30'){
				$entrys[1] = $result;
			}
		}
		if(!empty($entrys[0]) && $entrys[0][2]==$i.':00'){
			echo '<div class="busy">'.$i.':00 <div class="info">'.ucfirst($result[4]).' '.ucfirst($result[3]).' <br /><br />'.ucfirst($result[6]).'</div></div>';
		}else{
			echo '<div class="free">'.$i.':00 <div class="info"><a href="record.php?year='.$y.'&month='.$m.'&day='.$d.'&time='.$i.':00" class="record">Записатися</a></div></div>';
		}
		if(!empty($entrys[1]) && $entrys[1][2]==$i.':30'){
			echo '<div class="busy">'.$i.':30 <div class="info">'.ucfirst($result[4]).' '.ucfirst($result[3]).' <br /><br />'.ucfirst($result[6]).'</div></div>';
		}else{
			echo '<div class="free">'.$i.':30 <div class="info"><a href="record.php?year='.$y.'&month='.$m.'&day='.$d.'&time='.$i.':30" class="record">Записатися</a></div></div>';
		}
	}
	echo '</div>';
?>	
</body>
</html>