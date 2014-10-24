<form method='POST' action='/reservations/p_add'>

	
	<label for='guestname'>Name:</label><br>
	<input type='text' name='guestname'><br>

    <label for='gender'>Male or Female:</label><br>
	<select name='gender'>
		<option>M</option>
		<option>F</option>
	</select>
	
	<!-- invisibly posts id of logged in user -->
	<input type ='hidden' name='guestof' value="<?=$user->user_id?>"><br>

	
    <br><br>
    <input type='submit' value='Submit guest'>

</form> 
