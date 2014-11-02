<?php

class api_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/index/
	This class echos guest data in json to serve an api call
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
	
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/display/
	This class calls an external api
	-------------------------------------------------------------------------------------------------*/
	public function display() {
		
		# Consuming REST web service
		$rs="http://p3.spidercode.biz/api";
		$qs="";
		$uri="$rs?$qs";
		$cobj=curl_init($uri);
		curl_setopt($cobj,CURLOPT_RETURNTRANSFER,1);
		$json=curl_exec($cobj);
		echo $json;
		$data = json_decode($json);
		foreach ($data as $element => $value) {
			echo $element.'<br>';
			foreach ($value as $item) {
				echo $item.' ';
			}
		}

	} # End of method
	
	
} # End of class
