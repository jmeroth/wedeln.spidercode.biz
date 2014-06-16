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

    public function edit() {

        # Setup view
        $this->template->content = View::instance('v_reservations_edit');
        $this->template->title   = "Edit Post";

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


	public function p_index($guest_id) {

		# Unix timestamp of when this post was created / modified
		$_POST['modified'] = Time::now();

		# Modify guestlist
		# DB::instance(DB_NAME)->update('reservations', $_POST, "WHERE reservation_id ='".$reservation_id."'");
		DB::instance(DB_NAME)->delete('guests', "WHERE guest_id = '".$guest_id."'");
		# Quick and dirty feedback
        echo "Your guest list has been modified. <a href='/reservations'>return to guest list</a>";
    }

	public function users() {

	    # Set up the View
	    $this->template->content = View::instance('v_reservations_users');
	    $this->template->title   = "Users";

	    # Build the query to get all the users
	    $q = "SELECT *
	        FROM users";

	    # Execute the query to get all the users. 
	    # Store the result array in the variable $users
	    $users = DB::instance(DB_NAME)->select_rows($q);

	    # Build the query to figure out what connections does this user already have? 
	    # I.e. who are they following
	    $q = "SELECT * 
	        FROM users_users
	        WHERE user_id = ".$this->user->user_id;

	    # Execute this query with the select_array method
	    # select_array will return our results in an array and use the "users_id_followed" field as the index.
	    # This will come in handy when we get to the view
	    # Store our results (an array) in the variable $connections
	    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

	    # Pass data (users and connections) to the view
	    $this->template->content->users       = $users;
	    $this->template->content->connections = $connections;

	    # Render the view
	    echo $this->template;
	}

	public function venues() {

	    # Set up the View
	    $this->template->content = View::instance('v_reservations_venues');
	    $this->template->title   = "Venues";

	    # Build the query to get all the Venues
	    $q = "SELECT venue

	        FROM reservations GROUP BY venue";

	    # Execute the query to get all the venues. 
	    # Store the result array in the variable $venues
	    $venues = DB::instance(DB_NAME)->select_rows($q);

	    # Build the query to figure out what connections does this user already have? 
	    # I.e. who are they following
	    $q = "SELECT * 
	        FROM users_venues
	        WHERE user_id = ".$this->user->user_id;

	    # Execute this query with the select_array method
	    # select_array will return our results in an array and use the "venue_id_followed" field as the index.
	    # This will come in handy when we get to the view
	    # Store our results (an array) in the variable $connections
	    $connections = DB::instance(DB_NAME)->select_array($q, 'venue_followed');

	    # Pass data (venues and connections) to the view
	    $this->template->content->venues      = $venues;
	    $this->template->content->connections = $connections;

	    # Render the view
	    echo $this->template;
	}

	public function follow($user_id_followed) {

	    # Prepare the data array to be inserted
	    $data = Array(
	        "created" => Time::now(),
	        "user_id" => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );

	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);

	    # Send them back
	    Router::redirect("/reservations/users");

	}


	public function unfollow($user_id_followed) {

	    # Delete this connection
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);

	    # Send them back
	    Router::redirect("/reservations/users");

	}

	public function follow_venue($venue_followed) {

	    # Prepare the data array to be inserted
	    $data = Array(
	        "created" => Time::now(),
	        "user_id" => $this->user->user_id,
	        "venue_followed" => $venue_followed
	        );

	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_venues', $data);

	    # Send them back
	    Router::redirect("/reservations/venues");

	}


	public function unfollow_venue($venue_followed) {

	    # Delete this connection
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND venue_followed = '.$venue_followed;
	    DB::instance(DB_NAME)->delete('users_venues', $where_condition);

	    # Send them back
	    Router::redirect("/reservations/venues");

	}
	
	    public function logout() {
        # Generate and save a new token for next login
	    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

	    # Create the data array we'll use with the update method
	    # In this case, we're only updating one field, so our array only has one entry
	    $data = Array("token" => $new_token);

	    # Do the update
	    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

	    # Delete their token cookie by setting it to a date in the past - effectively logging them out
	    setcookie("token", "", strtotime('-1 year'), '/');

	    # Send them back to the main index.
	    Router::redirect("/");
    }
}
?>
