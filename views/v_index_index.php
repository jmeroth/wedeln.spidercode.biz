<p>
	Hello World! You have successfully spawned a new application.
</p>
<p>
	This message is being triggered via the c_index.php controller, within the index() method.
</p>


<div id='tune1' class='music'>Tune 1</div>
<div id='tune2' class='music'>Tune 2</div>
<div id='tune3' class='music'>Tune 3</div>
<div id='tune4' class='music'>Tune 4</div>


<select id="color">
	<option>red</option>
	<option>blue</option>
	<option>yellow</option>
	<option>green</option>
</select>
<input type="reset">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
	alert("Hi there.");

	$('#tune1').click(function() {   
        console.log("Hello World.");	
		$('#tune1').css('background-color',$( "#color" ).val());
    });

	$('#tune2').click(function() {   
        console.log("Hello World.");	
		$('#tune2').css('background-color',$( "#color" ).val());
    });

	$('#tune3').click(function() {   
        console.log("Hello World.");	
		$('#tune3').css('background-color',$( "#color" ).val());
    });

	$('#tune4').click(function() {   
        console.log("Hello World.");	
		$('#tune4').css('background-color',$( "#color" ).val());
    });

	$('input').click(function() {   
        console.log("Hello World.");
		$('body').css('background-color',$( "#color" ).val());
    });
</script>
