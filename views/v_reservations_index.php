<table width='40%' BORDER=0 CELLPADDING=3 CELLSPACING=1 
    RULES=ROWS FRAME=HSIDES>
	<tr>
		<th>Name</th>
		<th>Gender</th>
		<th>Room</th>
		<th></th>
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


<?php if($user->role == 'vp'): ?>	
	<form method='POST' action='/reservations/p_assign'>
		<tr style="background-color: #9D0000">
			<td></td><td></td><td><input type='submit' value='Assign rooms'></td><td></td>
		</tr>
	</form>
<?php endif; ?>

</table>

<!--  Display Room info 
      Would need to query room data and send it to the View using:
		$this->template->content->rooms = $rooms;
<table>
<?php foreach($rooms as $room): ?>
	<tr>
		<td><?=$room['roomid']?></td><td><?=$room['capacity']?></td><td><?=$room['occupancy']?></td><td>
	</tr>
<?php endforeach; ?>
</table>
-->