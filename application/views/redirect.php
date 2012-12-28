<html>
<head>
	<?php echo $head;?>

	<script type="text/javascript">  
		var count = 6;  
		var redirect="<?=$product->url?>"  
		  
		function countDown(){  
			if (count <=0){  
		    	window.location = redirect;  
			}else{  
		    	count--;  
		    	document.getElementById("timer").innerHTML = "This page will redirect in "+count+" seconds."  
		    	setTimeout("countDown()", 1000)  
			}  
		}  
	</script> 

</head>
<body>
	<div id="popup"></div>
	<div id="container">

		<?php echo $header;?>
		<script type="text/javascript">
		    /* remove drop-down top menu */
			$('#maincatbox').replaceWith('');	
			$('#mainassbox').replaceWith('');	
			$('#mainsalebox').replaceWith('');	
			$('#mainbrandbox').replaceWith('');	
			/* remove drop-down top menu */
		</script>

		<div class="smallbox">
	
		</div>

		<div id="products">
		
		
 
			<br>
			Afrofunk Clothing is sending you to buy on TheIconic.    
			  
			<span id="timer">  
				<script>  
				 	countDown();  
				</script>  
			</span>  
			<br>
			<br>		
			if it doesn't redirect, please click <a href="<?=$product->url?>">here</a>
			<br>
		    <img src="/store/images/ajax-loader.gif" />
		    <br>
			<?// var_dump($product)?>
		

			
			
			<div class="space">
			
			</div>
			
			<div class="itemfound">

			</div>

		</div>
		
   	    <br>
	    <?php echo $footer;?>		

	</div>

</body>
</html>
