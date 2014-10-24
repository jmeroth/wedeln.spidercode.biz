<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
<p>Welcome To Wedeln! Wedeln Ski & Outdoors Club is an active four-season club located in New Hampshire's Mt. Washington Valley.</p>

<!--
<p>This message is being triggered via the c_index.php controller, within the index() method.</p>
<div id="control">
	<select id="color">
		<option>red</option>
		<option>blue</option>
		<option>yellow</option>
		<option>green</option>
		<option>darkgreen</option>
		<option>pink</option>
	</select>
	<input type="reset" value="background">
</div>

<?php
for ($i=1; $i<5; $i++) {
	echo ("<div id='box$i' class='tile'>box $i</div>");
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

	$('input').click(function() {   
        console.log("Hello World.");
		$('body').css('background-color',$( "#color" ).val());
    });


	alert("Hi there.");


	$('#box1').click(function() {   
        console.log("Hello World.");	
		$('#box1').css('background-color',$( "#color" ).val());
    });
	$('#box2').click(function() {   
        console.log("Hello World.");	
		$('#box2').css('background-color',$( "#color" ).val());
    });
	$('#box3').click(function() {   
        console.log("Hello World.");	
		$('#box3').css('background-color',$( "#color" ).val());
    });
	$('#box4').click(function() {   
        console.log("Hello World.");	
		$('#box4').css('background-color',$( "#color" ).val());
    });

</script>
-->
