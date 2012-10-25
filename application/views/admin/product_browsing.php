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
						
						<input type="submit" value="filter">
					</div>
				
					<div id="main">
						<?php foreach($products as $product) {?>
						<div class="product-box">
							<h2><?php echo $product['product_name'];?></h2><br>
							<img src="<?php echo $product['image_url'];?>" border="1" width="180" />
							
						</div>
						<?php }?>
					</div>
				
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>