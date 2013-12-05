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
	echo ("<div id='tune$i' class='music'>Tune $i</div>");
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

	$('input').click(function() {   
        console.log("Hello World.");
		$('body').css('background-color',$( "#color" ).val());
    });


	alert("Hi there.");

/*

	for (var i=1; i<10; i++) {
		
		var myId = '#tune' + i;	
		
		$(myId).click(function() {   
	        console.log("Hello World.");	
			$(myId).css('background-color',$( "#color" ).val());
	    });
}
*/

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
	$('#tune5').click(function() {   
        console.log("Hello World.");	
		$('#tune5').css('background-color',$( "#color" ).val());
    });
	$('#tune6').click(function() {   
        console.log("Hello World.");	
		$('#tune6').css('background-color',$( "#color" ).val());
    });
	$('#tune7').click(function() {   
        console.log("Hello World.");	
		$('#tune7').css('background-color',$( "#color" ).val());
    });
	$('#tune8').click(function() {   
        console.log("Hello World.");	
		$('#tune8').css('background-color',$( "#color" ).val());
    });
	$('#tune9').click(function() {   
        console.log("Hello World.");	
		$('#tune9').css('background-color',$( "#color" ).val());
    });
	$('#tune10').click(function() {   
        console.log("Hello World.");	
		$('#tune10').css('background-color',$( "#color" ).val());
    });
	$('#tune11').click(function() {   
        console.log("Hello World.");	
		$('#tune11').css('background-color',$( "#color" ).val());
    });
	$('#tune12').click(function() {   
        console.log("Hello World.");	
		$('#tune12').css('background-color',$( "#color" ).val());
    });
	$('#tune13').click(function() {   
        console.log("Hello World.");	
		$('#tune13').css('background-color',$( "#color" ).val());
    });
	$('#tune14').click(function() {   
        console.log("Hello World.");	
		$('#tune14').css('background-color',$( "#color" ).val());
    });
	$('#tune15').click(function() {   
        console.log("Hello World.");	
		$('#tune15').css('background-color',$( "#color" ).val());
    });
	$('#tune16').click(function() {   
        console.log("Hello World.");	
		$('#tune16').css('background-color',$( "#color" ).val());
    });


</script>
