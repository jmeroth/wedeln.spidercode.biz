<form method='POST' action='/reservations/p_member/<?=$user['roomid']?>'>

	
	<label for='guestname'>Name</label>
	<input type='text' name='guestname' value="<?=$user->last_name?>"><br><br>
	
	<label for='sat_breakfast'>Saturday breakfast?</label>
	<input type='checkbox' name='sat_breakfast'><br>
	
	<label for='sat_dinner'>Saturday dinner?</label>
	<input type='checkbox' name='sat_dinner'><br>


	<!-- invisibly posts id of logged in user -->
	<input type ='hidden' name='guestof' value="<?=$user->user_id?>">
	<input type ='hidden' name='gender' value="<?=$user->gender?>">
	<input type ='hidden' name='roomid' value="<?=$user->roomid?>">
	<input type ='hidden' name='ismember' value=1>

	
    <br><br>
    <input type='submit' value='Submit guest'>

</form> 
