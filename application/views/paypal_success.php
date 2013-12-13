<html>
<head>

	<meta http-equiv="Content-Type" content="text/html" />
	<meta name="geo.region" content="AU-NSW" />
	<meta name="rating" content="general" />
	<meta name="language" content="English" />
	<meta name="robots" content="index,follow" />

	<?php echo $head;?>
	
	<title>Afrofunk Clothing Sydney</title>
	
	
</head>
<body>
	<div id="container">
		<?php echo $header;?>
		
		<form action="confirm" method="post">
			<input type="hidden" name="token" value="<?=$token?>" />
			<input type="hidden" name="payer_id" value="<?=$payer_id?>" />
			
			<div id="products">
			  paypal success return url  <input type="submit" value="test submit button">
			  <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
			</div>
		</form>
		
	</div>

	<br>
	<?php echo $footer;?>
</div>
</body>
</html>