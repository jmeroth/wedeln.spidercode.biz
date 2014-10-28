<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/app.css" type="text/css">
	
    <!-- Common JSS 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	-->
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>	
</head>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<body>
	<nav role='navigation'>
		<div class ='inner'>
			<a href="#nav" class="nav-collapse" id="nav-collapse">Menu</a>
			<ul class='nav' id='nav'>
			<li class='active'><a href='/'>Home</a></li>
			<li class='active'><a href='/links'>Links</a></li>
			<!-- Menu for users who are logged in -->
			<?php if($user): ?>
				<li><a href='/users/profile'>Profile</a></li>
				<li><a href='/reservations/member'>Reserve yourself</a></li>
				<li><a href='/reservations/guest'>Add a guest</a></li>
				<li><a href='/reservations/all'>View guests</a></li>
				<li><a href='/users/logout'>Logout</a></li>
				<?php if($user->role == 'vp'): ?>			
					<li><a href='/users/signup'>Sign up new member</a></li>
				<?php endif; ?>
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<li><a href='/users/login'>Log in</a></li>
			<?php endif; ?>
			</ul>
		</div>
	</nav>
	<div id='container'>
		<article class='main'>
			
			<section id='content'>
				<?php if(isset($content)) echo $content; ?>
				<?php if(isset($client_files_body)) echo $client_files_body; ?>
			</section>
		</article>
		<aside>		
			<section class='cat'>
				<img src='/uploads/avatars/Snowflake.gif' alt='Snowflake'>
			</section>
			<section class='banner'>
				<h2></h2>
			</section>
		</aside>
	</div><!-- /#container -->
	<script type="text/javascript" src="/js/yass.js"></script>
</body>
</html>
