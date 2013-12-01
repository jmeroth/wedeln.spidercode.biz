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
</select>
<input type="reset">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

	$('input').click(function() {   
        console.log("Hello World.");
		$('body').css('background-color',$( "#color" ).val());
    });

</script>
