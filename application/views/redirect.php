<html>
<head>
	<?php echo $head;?>

	<script type="text/javascript">

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
		</script>

		<div class="smallbox">
	
		</div>

		<div id="products">
		
		
		
			<?php var_dump($product)?>
		
		
		
		
		
		
			
			
			
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
