<?php

class api_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		header("Content-Type:application/json");
		$q = 'SELECT 
		guests.guest_id,
		guests.guestname,
		guests.gender,
		guests.roomid
		FROM guests';
			
	    # Run the guest query
	    $guests = DB::instance(DB_NAME)->select_rows($q);
		
	    $json_response = json_encode($guests);  					     		
		# provide the response
		echo $json_response;

	} # End of method
	
	
} # End of class
