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
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
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
} # End of class
