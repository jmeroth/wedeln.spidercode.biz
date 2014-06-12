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
	<div id='container'>
		<div id='menu'>
			<a href='/'>Home</a>
			<!-- Menu for users who are logged in -->
			<?php if($user): ?>
				<a href='/users/logout'>Logout</a>
				<a href='/users/profile'>Profile</a>
				<a href='/reservations/add'>Add guest</a>
				<a href='/reservations/'>View guests</a>

			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<a href='/users/signup'>Sign up</a>
				<a href='/users/login'>Log in</a>
			<?php endif; ?>
		</div>
		<article class='main'>
			<p>Responsive Web design is the approach that suggests that design and development should respond to the user's behavior and environment based on screen size, platform and orientation. The practice consists of a mix of flexible grids and layouts, images and an intelligent use of CSS media queries. As the user switches from their laptop to iPad, the website should automatically switch to accommodate for resolution, image size and scripting abilities. In other words, the website should have the technology to automatically respond to the user's preferences. This would eliminate the need for a different design and development phase for each new gadget on the market.</p>
			<section id='content'>
				<?php if(isset($content)) echo $content; ?>
				<?php if(isset($client_files_body)) echo $client_files_body; ?>
			</section>
		</article>
		<aside>
			<section class='activities'>
				<h2>Upcomming activities!</h2>
				<ul>
					<li>Hiking</li>
					<li>Golf</li>
					<li>Canoeing</li>
				</ul>
			</section>
			<section class='cat'>
				<img src='/uploads/avatars/example.gif' alt='Example'>
			</section>
			<section class='banner'>
				<h2>Reserve a spot at the house!</h2>
			</section>
		</aside>
	</div><!-- /#container -->
</body>
</html>
