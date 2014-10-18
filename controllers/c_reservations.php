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
		
        $this->template->title   = "Add Guests";

        # Render template
        echo $this->template;

    }



    public function p_add() {

        # Insert:  insert('table-name', array from forms post method)
        # Note didn't have to sanitize $_POST data because the insert method does it for us
        DB::instance(DB_NAME)->insert('guests', $_POST);

        # redirect to view the list of guests
		Router::redirect('/reservations');

    }

    

	public function index() {

		#echo "c_reservations index method called<br><br>";

	    # Set up the View
	    $this->template->content = View::instance('v_reservations_index');
	    $this->template->title   = "Guests to book";

	    # Build the guest query
	    $q = 'SELECT 
				guests.guest_id,
	            guests.guestname,
				guests.gender,
				guests.roomid
	        FROM guests WHERE guests.roomid is null';
	    # Run the guest query
	    $guests = DB::instance(DB_NAME)->select_rows($q);
		
		# Build the vacancy query
	    $v = 'SELECT 
				sum(rooms.capacity - rooms.occupancy) as vacancy
				FROM rooms';
	    # Run the vaconcy query
	    $vacancy = DB::instance(DB_NAME)->select_rows($v);
		echo "There are currently " . $vacancy[0]['vacancy'] . " beds remaining.";

	    # Pass data to the View
	    $this->template->content->guests = $guests;
	
	    # Render the View
	    echo $this->template;

	}
	
		public function all() {

	    # Set up the View
	    $this->template->content = View::instance('v_reservations_index');
	    $this->template->title   = "Guests to book";

	    # Build the guest query
		# Define the WHERE clause, if vp show all guests.
		if ($this->user->role == 'vp') {
			$clause=" WHERE 1";
		} else {
			$clause=" WHERE guests.guestof = '".$this->user->user_id."'";	
		}
	    $q = 'SELECT 
				guests.guest_id,
	            guests.guestname,
				guests.gender,
				guests.roomid
	        FROM guests'.$clause;
			
	    # Run the guest query
	    $guests = DB::instance(DB_NAME)->select_rows($q);
		
		# Build the vacancy query
	    $v = 'SELECT 
				sum(rooms.capacity - rooms.occupancy) as vacancy
				FROM rooms';
	    # Run the vaconcy query
	    $vacancy = DB::instance(DB_NAME)->select_rows($v);
		echo "There are currently " . $vacancy[0]['vacancy'] . " beds remaining.";

	    # Pass data to the View
	    $this->template->content->guests = $guests;
	
	    # Render the View
	    echo $this->template;

	}
	
		public function p_assign() {
		
	    # Set up the View
	    $this->template->content = View::instance('v_reservations_index');
	    $this->template->title   = "All guests";
		
	    # Build the query
	    $q = 'SELECT 
				guests.guest_id,
	            guests.guestname,
				guests.gender,
				guests.roomid
	        FROM guests
			WHERE guests.roomid is NULL';

	    # Run the query
	    $guests = DB::instance(DB_NAME)->select_rows($q);
				
		# Assign rooms to guests
		foreach ($guests as $guest) {
			$mygender = $guest['gender'];
			$r = "SELECT 
				rooms.roomid,
	            rooms.gender,
				rooms.fillorder,
				rooms.capacity,
				rooms.occupancy
				FROM rooms
				WHERE gender = '".$mygender."'
				and occupancy != capacity";
			$rooms = DB::instance(DB_NAME)->select_rows($r);
			$roomarray = array_pop($rooms);
			$num = $roomarray['roomid'];		
			$myRoom = array("roomid" => $num);
			DB::instance(DB_NAME)->update('guests', $myRoom, "WHERE guest_id = '".$guest['guest_id']."'");
			
			# Adjust up room occupancy
			$newocc = $roomarray['occupancy'] + 1;
			$myocc = array("occupancy" => $newocc);
			DB::instance(DB_NAME)->update('rooms', $myocc, "WHERE roomid = '".$num."'");	
		}
		
		# re-build the query
	    $q = 'SELECT 
				guests.guest_id,
	            guests.guestname,
				guests.gender,
				guests.roomid
	        FROM guests
			WHERE guests.roomid is NULL';

	    # Re-run the query
	    $guests = DB::instance(DB_NAME)->select_rows($q);
	    # Pass data to the View
	    $this->template->content->guests = $guests;
	
	    # Render the View
	    echo $this->template;
		
		# redirect to view the list of guests
		Router::redirect("/reservations");
		

	}


	public function p_remove($guest_id) {

		# Unix timestamp of when this post was created / modified
		$_POST['modified'] = Time::now();

		# Identify room that guest is removed from
		$gr = "SELECT 
			guests.roomid
			FROM guests
			WHERE guest_id = '".$guest_id."'";
		$guestroom = DB::instance(DB_NAME)->select_field($gr);			
		
		# select this record from table rooms
		$r = "SELECT 
			rooms.roomid,
			rooms.gender,
			rooms.fillorder,
			rooms.capacity,
			rooms.occupancy
			FROM rooms
			WHERE roomid = '".$guestroom."'";
		$rooms = DB::instance(DB_NAME)->select_rows($r);
		
		# Adjust down room occupancy
		$newocc = $rooms[0]['occupancy'] - 1;
		$myocc = array("occupancy" => $newocc);
		DB::instance(DB_NAME)->update('rooms', $myocc, "WHERE roomid = '".$guestroom."'");			

		# Remove a record from guestlist
		# DB::instance(DB_NAME)->update('reservations', $_POST, "WHERE reservation_id ='".$reservation_id."'");
		DB::instance(DB_NAME)->delete('guests', "WHERE guest_id = '".$guest_id."'");
		# Redirect to show reservations
		Router::redirect("/reservations/all/");
    }


}
?>
