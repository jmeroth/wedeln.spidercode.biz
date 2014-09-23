<?php
class reservations_controller extends base_controller {

    public function __construct() {
        parent::__construct();
		#echo "reservations_controller construct called<br><br>";
        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    }

    public function add() {

        # Setup view
        $this->template->content = View::instance('v_reservations_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

    }



    public function p_add() {

        # Insert
        # Note didn't have to sanitize $_POST data because the insert method does it for us
        DB::instance(DB_NAME)->insert('guests', $_POST);  //insert('table-name', array from forms post method)

		echo "<br/>***<br/>";
		# current post
        print_r($_POST);
		echo "<br/>***<br/>";

        # Quick and dirty feedback
        echo "Your guest has been added. <a href='/reservations/add'>Add another</a>";

    }

    

	public function index() {

		#echo "c_reservations index method called<br><br>";

	    # Set up the View
	    $this->template->content = View::instance('v_reservations_index');
	    $this->template->title   = "All guests";

	    # Build the query
	    $q = 'SELECT 
				guests.guest_id,
	            guests.guestname,
				guests.gender
	        FROM guests';

	    # Run the query
	    $guests = DB::instance(DB_NAME)->select_rows($q);

	    # Pass data to the View
	    $this->template->content->guests = $guests;
	
	    # Render the View
	    echo $this->template;

	}


	public function p_remove($guest_id) {

		# Unix timestamp of when this post was created / modified
		$_POST['modified'] = Time::now();

		# Remove a record from guestlist
		# DB::instance(DB_NAME)->update('reservations', $_POST, "WHERE reservation_id ='".$reservation_id."'");
		DB::instance(DB_NAME)->delete('guests', "WHERE guest_id = '".$guest_id."'");
		# Quick and dirty feedback
        echo "Your guest list has been modified. <a href='/reservations'>return to guest list</a>";
    }


}
?>
