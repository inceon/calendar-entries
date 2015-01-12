﻿<? 
function my_calendar($y, $m) { 
	if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
	if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");
	
	$month_stamp=mktime(0,0,0,$m,1,$y);
	$day_count=date("t",$month_stamp);
	$weekday=date("w",$month_stamp);
	if ($weekday==0) $weekday=7;
	$start=-($weekday-2);
	$last=($day_count+$weekday-1) % 7;
	if ($last==0) $end=$day_count; else $end=$day_count+7-$last;
	$i=0;
	$result = "<table id='month-table'>";
	$result .= "<tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td><tr>";
	
	$content = file ('data/'.$m.'.txt');
	require('config.php');
	
	for($d=$start;$d<=$end;$d++) { 
		if (!($i++ % 7)) $result .= "<tr>\n";
		
		$result .= '<td>';
		if ($d < 1 OR $d > $day_count) {
			$result .= "<div class=\"d\">&nbsp</div>";
		} else {
			$vd = date("w",strtotime("$d.$m.$y"));
			$count = 0;
			foreach ($content as $line) { 
				$res = explode ('::', $line);
				if($res[1]==$d) $count++;
			}
			$proc = ($count==0)?0:($count/$entries)*100;
			$result .= '<a href="day.php?year='.$y.'&month='.$m.'&day='.$d.'"><div class="d" onmouseover="this.style.backgroundImage=\'linear-gradient(to top, rgba(220,220,220,0.5) '.$proc.'%, rgba(255, 255, 255, 0) '.$proc.'%, rgba(255, 255, 255, 0) 100%, rgba(220,220,220,0.5) 100%)\';" 
    onmouseout="this.style.backgroundImage=\'linear-gradient(to top, rgba(220,220,220,0.5) 0%, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0) 100%, rgba(220,220,220,0.5) 100%)\';">';
			$result .= ($vd==6 || $vd==0)?'<span style="color: #d43134">'.$d.'</span>':$d;
			$result .= '</div></a>';
		} 
		$result .= "</td>\n";
		if (!($i % 7))  $result .= "</tr>\n";
	} 
	$result .= "</table> ";
	return $result;
} 
?>
