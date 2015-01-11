<? include_once('config.php') ?>
<?php	
	if(isset($_GET['add'])){
		$add = intval($_GET['add']);
		$content = file ('data/temp.txt');
		$result = explode('::', $content[$add]);
		$fp = fopen('data/'.$result[1].'.txt', 'a');
		fwrite($fp, $result[0].'::'.$result[2].'::'.$result[3].'::'.$result[4].'::'.$result[5].'::'.$result[6].'::'.$result[7]);
		fclose($fp);
		unset($content[$add]);
		$fp = fopen("data/temp.txt","w");
		fputs($fp, implode("",$content));
		fclose($fp);
		header ('Location: admin.php');
	}
	if(isset($_GET['del'])){
		$del = intval($_GET['del']);
		$file=file("data/temp.txt");
		$fp=fopen("data/temp.txt","w");
		unset($file[$del]);
		fputs($fp,implode("",$file));
		fclose($fp);
		header ('Location: admin.php');
	}
?>
<!DOCTYPE>
<html>
<head> 
<title>Панель адміністратора</title>
<link rel="stylesheet" type="text/css" href="style.css" /> 
<script type="text/javascript" src="jquery-2.1.3.min.js"> </script>
<script type="text/javascript" src="main.js"> </script>
</head>
<body>
<?php
	
	echo "<a href='index.php'><div id=\"logo-text\">Панель адміністратора</div></a>";
	echo '<div id="calendar">';
	
	$content = file ('data/temp.txt');
	$i = 0;
	foreach ($content as $line) { 
		$result = explode ('::', $line); 
		echo '<div class="month" style="display: block; min-height:0; height: auto; text-align: left; padding-left: 1%;">'.$result[2].'.'.$result[1].'.'.$result[0].' '.$result[3].'<br />'.ucfirst($result[4]).' '.ucfirst($result[5]).'<br />'.$result[6].'<br />'.$result[7];
		echo '<div class="del-add"><a href="?del='.$i.'">x</a>  <a href="?add='.$i.'">+</a></div>';
		echo '</div>';
		$i++;
	}
	echo '</div>';
?>	
</body>
</html>