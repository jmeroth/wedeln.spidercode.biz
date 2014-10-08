<table border='1' width='25'>

<?php foreach($guests as $guest): ?>
<form method='POST' action='/reservations/p_remove/<?=$guest['guest_id']?>'>
	<tr>
		<td><?=$guest['guestname']?></td>
		<td><?=$guest['gender']?></td>
		<td><?=$guest['roomid']?></td>
		<td><input type='submit' value='remove'></td>
	</tr>
</form>
<?php endforeach; ?>





<form method='POST' action='/reservations/p_assign'>
	<tr>
		<td></td><td><input type='submit' value='Assign room now!'></td>
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