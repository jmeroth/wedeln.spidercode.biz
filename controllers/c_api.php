<?php

class api_controller extends base_controller {
	

	public function __construct() {
		parent::__construct();
	} 


	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/index/	index() echos data from 'guests' table to serve an api call
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
	Accessed via http://localhost/api/weather/	This method dislays wunderground.com weather api
	-------------------------------------------------------------------------------------------------*/
	public function weather() {
        # Setup view
        $this->template->content = View::instance('v_api_weather');
        $this->template->title   = "Current Weather";
		
		$json_string = file_get_contents("http://api.wunderground.com/api/ac31ac78b643946d/conditions/q/NH/North_Conway.json");
		$parsed_json = json_decode($json_string);
		# print_r('parsed_json');
		$location = $parsed_json->{'current_observation'}->{'observation_location'}->{'city'};
		$temp_s = $parsed_json->{'current_observation'}->{'temperature_string'};
		$forecast = $parsed_json->{'current_observation'}->{'forecast_url'};
		$currweather = "<br>Current temperature in ${location} is:  ${temp_s}\n";
		

		# Pass data to the view
    	$this->template->content->currweather = $currweather;
		$this->template->content->forecast = $forecast;

    	# Render template
        echo $this->template;
    }
	
	
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/display/		This method displays an external api
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
		
		/* Test of Parsing WildApricot json */
		echo '<br><br>'."WildApricot file parse Test".'<br><br>';
		#$jsondata = file_get_contents("C:\\xampp\\htdocs\\p3.spidercode.biz\\controllers\\contacts.json");
		$jsondata = file_get_contents("C:\\xampp\\htdocs\\wedeln.spidercode.biz\\controllers\\registrants.json");
		$json = json_decode($jsondata, true);
		$output = "";
		foreach($json as $member) {
			$output .= "<em>".$member["Contact"]["Name"]."<br></em>";
		}
		echo $output;
		echo '<br><br>';	

	} # End of method
	
	
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/contacts/		This method displays file "contacts.json"
	-------------------------------------------------------------------------------------------------*/
	public function contacts() {
		
		/* Test of Parsing WildApricot json */
		echo '<br><br>'."WildApricot Wedeln Contacts".'<br><br>';
		$jsondata = file_get_contents("C:\\xampp\\htdocs\\p3.spidercode.biz\\controllers\\contacts.json");
		$json = json_decode($jsondata, true);
		
		$output = "";
		foreach($json["Contacts"] as $member) {
			$output .= "<em>".$member["DisplayName"]."<br></em>";
		}
		echo $output;
		echo '<br><br>';	

	} # End of method
	
	
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/api/wild/		This method connects to WildApricot
	-------------------------------------------------------------------------------------------------*/
	public function wild($user_name = NULL) {
        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # Setup view
        $this->template->content = View::instance('v_api_display');
        $this->template->title = "API Display";
 
        # Obtain access token using refresh token
        $uri="https://oauth.wildapricot.org/auth/token";
        $cobj=curl_init($uri);
		$header = array('Authorization: Basic QVBJS0VZOjRzdmhfcnBmcDFxMzcyMjBna2txdDBuNGFsY2U1MA==', 
			'Content-Type: application/x-www-form-urlencoded');
		
        curl_setopt($cobj,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($cobj,	CURLOPT_HTTPHEADER, $header);
		curl_setopt($cobj,CURLOPT_POST,1);
		curl_setopt($cobj,CURLOPT_POSTFIELDS,"grant_type=refresh_token&refresh_token=s9Nud54EleyLth-0L4NvEliphyo-");
		curl_setopt($cobj, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($cobj, CURLOPT_SSL_VERIFYHOST, 2);
		
        $json=curl_exec($cobj);
		curl_close($cobj);
		$data = json_decode($json);

		$accessToken = $data->{'access_token'};
		
		
		#############################################################################
		
		# get request for list of registrants
		$rs="https://api.wildapricot.org/v2/accounts/178224/EventRegistrations/";      # url and path
        $qs="eventId=1819786";
        $uri=$rs.'?'.$qs;
		$cobj=curl_init($uri);
        
		$header = array('Authorization: Bearer '.$accessToken);

		curl_setopt($cobj,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($cobj,	CURLOPT_HTTPHEADER, $header);
		curl_setopt($cobj, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($cobj, CURLOPT_SSL_VERIFYHOST, 2);
        $json=curl_exec($cobj);
		curl_close($cobj);
		#echo $json;
		#print_r($json);
		
        $data = json_decode($json, true);
		
		
		#print_r($data);
		
		$output = "";
		foreach($data as $member) {
			$output .= "<em>".$member["Contact"]["Name"]."<br></em>";
		}
		#echo $output;
		#echo '<br><br>';
		
		

		$guestname = $output;
        #$guestname = $data[0]->{'guestname'};
		#$guestname = $data;
		# Pass information to the view fragment
		
		#############################################################################
		
		
		
		$this->template->content->guestname = $guestname;
		
		# Render View
        echo $this->template;
		
    }
	
	
	
	
} # End of class
