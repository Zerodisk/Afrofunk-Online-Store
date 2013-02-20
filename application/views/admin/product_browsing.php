<html>
	<head>
		<?php echo $head;?>
		<script>
			function fnViewProduct(sku){
				window.open('product/view/' + sku, sku,'width=1010,height=700');
			}

			function fnFiterSubmit(){
				document.frmMain.page.value = 0;
				document.frmMain.submit();
			}

			function fnGoPage(page){
				document.frmMain.page.value = page;
				document.frmMain.submit();
			}

			function renderPrice(priceInit, priceNow, priceSaving){
				if (priceSaving == 0){
					document.write('<div class="price-normal">');
					document.write('$' + priceNow.toFixed(2));
				}
				else{
					document.write('<div class="price-discount">');
					document.write('<span class="price-strike">was $' + priceInit.toFixed(2) + '</span>  now is $' + priceNow.toFixed(2));
				}

				document.write('</div>');
				
			}

			function fnCheckBrand(isCheck){
				$('.chkBrand').each(function(){
					this.checked = isCheck;
				});
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
						<input type="button" value="filter" onClick="fnFiterSubmit()"><br><br>
						
						status<br>
						<?php echo $status_selectbox;?><br>
						
						merchants<br>
						<?php echo $mids_selectbox;?><br>
						
						brands:<br>
						<?php echo $brands_selectbox;?>
						
						&nbsp;&nbsp;<a href="javascript:fnCheckBrand(true);">check all</a> | <a href="javascript:fnCheckBrand(false);">uncheck all</a><br><br>
						
						<input type="button" value="filter" onClick="fnFiterSubmit()">
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
							
							<div class="product-name" <?php if ($product['date_created'] > $date_last_push) {echo('style="color:red"');} ?>><?php echo $product['product_name'];?></div><br>
							
							<div class="sku">SKU: <?php echo $product['sku'];?></div><br>
							
							<center>
							<a href="javascript:fnViewProduct('<?php echo $product['sku'];?>')">
								<img src="<?php echo $product['image_url'];?>" border="1" width="180" />
							</a>
							</center><br>
													
							<script>renderPrice(<?=$product['price_init']?>, <?=$product['price_now']?>, <?=$product['price_saving']?>);</script><br>
							
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