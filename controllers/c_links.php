<?php

class links_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/links/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_links');
			
		# Now set the <title> tag
			$this->template->title = "Links";
			
	
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		
		
		# Render the view
			echo $this->template;
			
		# Our SQL command
		/*
		$q = "INSERT INTO users SET 
			first_name = 'Sam', 
			last_name = 'Seaborn',
			email = 'seaborn@whitehouse.gov'";
		
		# Run the command
		echo DB::instance(DB_NAME)->query($q);
		*/

	} # End of method
	
	
} # End of class
