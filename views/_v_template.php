<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/app2.css" type="text/css">
	
    <!-- Common JSS 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	-->
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>	
</head>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<body>
	<?php include_once("/js/analyticstracking.php") ?>
	<nav role='navigation'>
		<div class ='inner'>
			<a href="#nav" class="nav-collapse" id="nav-collapse">Menu</a>
			<ul class='nav' id='nav'>
			<li class='active'><a href='/'>Home</a></li>
			<li class='active'><a href='/links'>Links</a></li>
			<li class='active'><a href='/api/weather'>Weather</a></li>
			<!-- Menu for users who are logged in -->
			<?php if($user): ?>
				<li class='active'><a href='/users/profile'>Profile</a></li>
				<!-- <li class='active'><a href='/reservations/member'>Reserve yourself</a></li> -->
				<!-- <li class='active'><a href='/reservations/guest'>Add a guest</a></li> -->
				<!-- <li class='active'><a href='/reservations/all'>View guests</a></li>	-->	
				<?php if($user->role == 'vp'): ?>			
					<li class='active'><a href='/users/signup'>Sign up new member</a></li>
					<li class='active'><a href='/api/wild'>api data</a></li>
				<?php endif; ?>
				<li class='active'><a href='/users/logout'>Logout</a></li>
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<li class='active'><a href='/users/login'>LOGIN</a></li>
			<?php endif; ?>
			</ul>
		</div>
	</nav>
	<header role="banner">
        <div class="inner">
           <h1 class="logo"><a href="#"><img src='/uploads/WelcomeWedeln.JPG' alt='Welcome picture'></a></h1>
        </div><!-- /.inner -->
     </header>

		<div id='container'>
				
				<?php if(isset($content)) echo $content; ?>
				<?php if(isset($client_files_body)) echo $client_files_body; ?>
			
		</div><!-- /#container -->

	<script type="text/javascript" src="/js/yass.js"></script>
</body>
</html>
