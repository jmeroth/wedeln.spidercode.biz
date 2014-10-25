<form method='POST' action='/reservations/p_add'>

	
	<label for='guestname'>Name</label>
	<input type='text' name='guestname'><br><br>

    <label for='gender'>Male or Female</label>
	<select name='gender'>
		<option>M</option>
		<option>F</option>
	</select><br>

	<label for='sat_breakfast'>Saturday breakfast?</label>
	<input type='checkbox' name='sat_breakfast'><br>
	
	<label for='sat_dinner'>Saturday dinner?</label>
	<input type='checkbox' name='sat_dinner'><br>
	
	<!-- invisibly posts id of logged in user -->
	<input type ='hidden' name='guestof' value="<?=$user->user_id?>"><br>

	
    <br><br>
    <input type='submit' value='Submit guest'>

</form> 
