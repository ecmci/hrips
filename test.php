<?php


//$date = '2013-04-23 11:00:00';
//$add_hours = '0';
//$add_min = '89';
//echo "$date + $add_hours hours $add_min minutes = ".date('Y-m-d H:i:s',strtotime("+1 hours 0 minutes",strtotime($date)));
//echo '<pre>';print_r(explode(' ',"1 hours 0 minutes"));echo '</pre>';
echo "now is: ".date('Y-m-d H:i:s',time());
echo '<br>';
echo "yesterday is: ".date('Y-m-d 16:30:00',strtotime('-1 days',time()));
phpinfo();
?>
