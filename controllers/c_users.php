<?php
class users_controller extends base_controller {
	

	public function __construct() {
		parent::__construct();
	} 
		
	public function index() {
        echo "This is the index page";
    }
	
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/users/signup/
	-------------------------------------------------------------------------------------------------*/
	public function signup() {
		
		# Setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title = "Sign Up";
	      					     		
		# Render template
			echo $this->template;
	}
	
	public function p_signup() {
		
        # Dump out the results of POST to see what the form submitted
        // print_r($_POST);

		# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();

		# Encrypt the password  
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

    	# Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

		# Insert this user into the database
    	$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

		# Send an email to the user's email address.
			# Build a multi-dimension array of recipients of this email
		$to[] = Array("name" => $_POST['first_name'], "email" => $_POST['email']);

			# Build a single-dimension array of who this email is coming from
			# note it's using the constants we set in the configuration above)
		$from = Array("name" => APP_NAME, "email" => APP_EMAIL);

			# Subject
		$subject = "Welcome to LocalTunes";

			# You can set the body as just a string of text
		$body = "This is just a message to confirm your registration at p2.spidercode.biz";

			# if email is complex and involves HTML/CSS, you can build the body via a View like we do in our controllers
			# $body = View::instance('e_users_welcome');

			# Build multi-dimension arrays of name / email pairs for cc / bcc if you want to 
		$cc  = "";
		$bcc = "";

			# With everything set, send the email
		$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

    	# Confirm they've signed up - 
    	# You should eventually make a proper View for this
    	#echo 'You\'re signed up';
        Router::redirect("/users/login");
	}
	
	public function login($error = null) {
        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

		# Pass data to the view
    	$this->template->content->error = $error;

    	# Render template
        echo $this->template;
    }

	public function p_login() {

	    # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
	    $_POST = DB::instance(DB_NAME)->sanitize($_POST);

	    # Hash submitted password so we can compare it against one in the db
	    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

	    # Search the db for this email and password
	    # Retrieve the token if it's available
	    $q = "SELECT token 
	        FROM users 
	        WHERE email = '".$_POST['email']."' 
	        AND password = '".$_POST['password']."'";

	    $token = DB::instance(DB_NAME)->select_field($q);

#my 'challenge' code ************************************************
		$q2 = "SELECT email 
	        FROM users 
	        WHERE email = '".$_POST['email']."' ";

		$email = DB::instance(DB_NAME)->select_field($q2);

	    # If we didn't find a matching token in the database, it means login failed
	    if(!$token) {
			if (!$email) {
				# Send back to login "Email Wrong"
				Router::redirect("/users/login/email_error");
			} else {
	        	# Send back to login "Password Wrong"
	        	Router::redirect("/users/login/password_error");
			}
# ********************************************************************

	    # But if we did, login succeeded! 
	    } else {

	        /* 
	        Store this token in a cookie using setcookie()
	        Important Note: *Nothing* else can echo to the page before setcookie is called
	        Not even one single white space.
	        param 1 = name of the cookie
	        param 2 = the value of the cookie
	        param 3 = when to expire
	        param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
	        */
	        setcookie("token", $token, strtotime('+1 year'), '/');

	        # Send them to the main page - or whever you want them to go
	        Router::redirect("/");

	    }
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
	
	public function profile($user_name = NULL) {

		# If user is blank, they're not logged in; redirect them to the login page
    	if(!$this->user) {
        	Router::redirect('/users/login');
    	}

		# If they weren't redirected away, continue:

    	# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title = "Profile of".$this->user->first_name;

    	# Create an array of 1 or many client files to be included in the head
    	$client_files_head = Array(
        		'/css/widgets.css',
        		'/css/profile.css'
        	);

		# Use load_client_files to generate the links from the above array
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);

		# Create an array of 1 or many client files to be included before the closing </body> tag
		$client_files_body = Array(
        	'/js/widgets.min.js',
        	'/js/profile.min.js'
        	);

		# Use load_client_files to generate the links from the above array
    	$this->template->client_files_body = Utils::load_client_files($client_files_body); 

		# Pass information to the view fragment
    	$this->template->content->user_name = $user_name;

    	# Pass information to the view instance
    	$this->user_name = $user_name; // creating a new property: $this->user_name

    	# Render View
    	echo $this->template;
    }
} # End of class
