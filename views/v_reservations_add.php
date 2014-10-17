<form method='POST' action='/reservations/p_add'>

	
	<label for='guestname'>Name:</label><br>
	<input type='text' name='guestname'><br>

    <label for='gender'>M or F:</label><br>
	<input type ='text' name='gender'><br>
	
	<label for='guestof'>Guest of:</label><br>
	<input type ='text' name='guestof' value="<?=$user->user_id?>"><br>

	
    <br><br>
    <input type='submit' value='add guest'>

</form> 
