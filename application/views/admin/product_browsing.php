<html>
	<head>
		<?php echo $head;?>
		<script>
			function fnViewProduct(sku){
				window.open('product/view/' + sku, sku,'width=910,height=700');
			}

			function fnGoPage(page){
				document.frmMain.page.value = page;
				document.frmMain.submit();
			}
		</script>
	</head>
	<body>
		<div id="container">
		    <?php echo $header;?>
			<div id="content">
				<form name="frmMain" method="get">
				    <input type="hidden" name="page" value="<?=$page?>">
					<div id="filter">
						<input type="submit" value="filter"><br><br>
						
						status<br>
						<?php echo $status_selectbox;?><br>
						
						brand:<br>
						<?php echo $brands_selectbox;?><br>
						
						<input type="submit" value="filter">
					</div>
				
					<div id="main">
						<div style="text-align:right">
						    <?php 						   
					    	if ($page > 0){
								echo '<input type="button" value="previous" onclick="fnGoPage('.($page - 1).')">';
							}
						    ?>
							page: <?=$page+1?>
							<?php 
							if (count($products) >= $page_size){
								echo '<input type="button" value="next" onclick="fnGoPage('.($page + 1).')">';
							}
							?>
						</div>
					
						<?php foreach($products as $product) {?>
						<div class="product-box">
							<h3><?php echo $product['product_name'];?></h3><br>
							<div class="sku">SKU: <?php echo $product['sku'];?></div><br>
							<img src="<?php echo $product['image_url'];?>" border="1" width="180" /><br>
							<div class="<?php if($product['price_saving'] == 0){echo('price-normal');}else{echo('price-discount');} ?>">
								$<?php echo $product['price_now'];?>
								<?php if($product['price_saving'] != 0){echo(' - (was $'.$product['price_init'].')');}?>
							</div><br>
							<div class="more-detail"><a href="javascript:fnViewProduct('<?php echo $product['sku'];?>')">more</a></div>
							
						</div>
						<?php }?>
					</div>
				
				</form>
			</div>
			<?php echo $footer;?>
		</div>
	</body>
</html>