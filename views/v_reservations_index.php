<h2>You entered:</h2>
<table border='1'>
<?php foreach($guests as $guest): ?>


<form method='POST' action='/reservations/p_remove/<?=$guest['guest_id']?>'>

	<tr>
		<td><?=$guest['guestname']?></td><td><?=$guest['gender']?></td><td><input type='submit' value='remove'></td>
	</tr>

</form>


<?php endforeach; ?>


<form method='POST' action='/reservations/p_assign'>

	<tr>
		<td></td><td>reservation</td><td><input type='submit' value='Assign now!'></td>
	</tr>

</form>


</table>