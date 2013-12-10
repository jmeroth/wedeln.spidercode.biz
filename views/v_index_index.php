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
for ($i=1; $i<17; $i++) {
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
	$('#box5').click(function() {   
        console.log("Hello World.");	
		$('#box5').css('background-color',$( "#color" ).val());
    });
	$('#box6').click(function() {   
        console.log("Hello World.");	
		$('#box6').css('background-color',$( "#color" ).val());
    });
	$('#box7').click(function() {   
        console.log("Hello World.");	
		$('#box7').css('background-color',$( "#color" ).val());
    });
	$('#box8').click(function() {   
        console.log("Hello World.");	
		$('#box8').css('background-color',$( "#color" ).val());
    });
	$('#box9').click(function() {   
        console.log("Hello World.");	
		$('#box9').css('background-color',$( "#color" ).val());
    });
	$('#box10').click(function() {   
        console.log("Hello World.");	
		$('#box10').css('background-color',$( "#color" ).val());
    });
	$('#box11').click(function() {   
        console.log("Hello World.");	
		$('#box11').css('background-color',$( "#color" ).val());
    });
	$('#box12').click(function() {   
        console.log("Hello World.");	
		$('#box12').css('background-color',$( "#color" ).val());
    });
	$('#box13').click(function() {   
        console.log("Hello World.");	
		$('#box13').css('background-color',$( "#color" ).val());
    });
	$('#box14').click(function() {   
        console.log("Hello World.");	
		$('#box14').css('background-color',$( "#color" ).val());
    });
	$('#box15').click(function() {   
        console.log("Hello World.");	
		$('#box15').css('background-color',$( "#color" ).val());
    });
	$('#box16').click(function() {   
        console.log("Hello World.");	
		$('#box16').css('background-color',$( "#color" ).val());
    });


</script>
