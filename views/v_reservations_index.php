<h2>You entered:</h2>
<table border='1'>
<?php foreach($guests as $guest): ?>


<form method='POST' action='/reservations/p_index/<?=$guest['guest_id']?>'>

	<tr>
		<td><?=$guest['guestname']?></td><td><?=$guest['gender']?></td><td><input type='submit' value='remove'></td>
	</tr>

</form>


<?php endforeach; ?>

</table>