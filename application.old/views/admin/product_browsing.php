<html>
	<head>
		<?php echo $head;?>
	</head>
	<body>
		<div id="container">
		    <?php echo $header;?>
			<div id="content">
				<form name="" id="" method="get">
					<div id="filter">
						<input type="submit" value="filter"><br><br>
						
						status<br>
						<?php echo $status_selectbox;?><br>
						
						brand:<br>
						<?php echo $brands_selectbox;?><br>
						
						<br><input type="submit" value="filter">
					</div>
				
					<div id="main">
					
					
					</div>
				
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>