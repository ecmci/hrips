<table border="1" class="">
<thead><tr><th>Clocked In</th><th>Clocked Out</th><th>Break</th><th>Job Code</th></tr></thead>
<tbody>
<?php
foreach($data->data as $r){
	echo '<tr>';
	echo '<td>'.(($r['ClockedIn']!=null) ? WebApp::formatPunchDatetime($r['ClockedIn']) : '').'</td>';
	echo '<td>'.(($r['ClockedOut']!=null) ? WebApp::formatPunchDatetime($r['ClockedOut']) : '').'</td>';
	echo '<td>'.(($r['BreakAfter']=='1')?'Yes':'No').'</td>';
	echo '<td>'.$r['JobCode'].'</td>';
	echo '</tr>';
}
?>
</tbody>
</table>