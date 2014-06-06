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

<body>	
	<div id='menu'>

        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>
			<a href='/posts/add'>Add Post</a>
			<a href='/posts/'>View/Edit Posts</a>
			<a href='/posts/users'>Follow Users</a>
			<a href='/posts/venues'>Follow Venues</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>

        <?php endif; ?>

    </div>

    <br>
	<div id='banner'>
		<img src='/uploads/avatars/example.gif' alt='Example'>
		Wereserve -
		Reserve a bed at the Wedeln club house!
	</div>
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>
