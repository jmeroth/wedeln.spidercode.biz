<table width='40%' BORDER=0 CELLPADDING=3 CELLSPACING=1 
    RULES=ROWS FRAME=HSIDES>
	<tr>
		<th>Name</th>
		<th>Sex</th>
		<th>Room</th>
	<tr/>
<?php foreach($guests as $guest): ?>
<form method='POST' action='/reservations/p_remove/<?=$guest['guest_id']?>'>
	<tr>
		<td><?=$guest['guestname']?></td>
		<td align='center'><?=$guest['gender']?></td>
		<td align='center'><?=$guest['roomid']?></td>
		<td><input type='submit' value='remove'></td>
	</tr>
</form>
<?php endforeach; ?>



<form method='POST' action='/reservations/p_assign'>
	<tr>
		<td></td><td></t><td><input type='submit' value='Assign room now!'></td>
	</tr>
</form>

</table>

<!--  Display Room info
<table>
<?php foreach($rooms as $room): ?>
	<tr>
		<td><?=$room['roomid']?></td><td><?=$room['capacity']?></td><td><?=$room['occupancy']?></td><td>
	</tr>
<?php endforeach; ?>
</table>
-->