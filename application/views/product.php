<html>
<head>
	<?php echo $head;?>
</head>
<body>
	<div id="container">

		<?php echo $header;?>
		
		<div class="smallbox">
	
		</div>
			
		<div id="products">
			<br>
		
		    <!-- copy from view_popup -- start here -->
			<div id="containerPopup">

				<br>
				
				<div id="photobox">
				
					<div id="mainphoto">
						<img src="<?=$product->image_url?>" width="351">
					</div>
					
					<div id="subphoto">
						<div class="photo1">
							<img src="<?=$product->image_url?>" width="108">
						</div>
						
						
						<?php 
						$imgUrl = '';
						if (count($photos) >= 1){
							$imgUrl = $photos[0]['url'];
						
						?>
						<div class="photo2">
							<img src="<?=$imgUrl?>" width="108" />
						</div>
						<?php 
						}
						?>
						
						
						<?php 
						if (count($photos) >= 2){
							$imgUrl = $photos[1]['url'];

						?>
						<div class="photo3">
							<img src="<?=$imgUrl?>" width="108" />
						</div>
						<?php 
						}
						?>
						
					</div>				
				
					<div id="productdetailbox">
				
						<div class="brandandnamebox">
							
							<div class="brandbox">
								<?=$product->brand?>
							</div>
							
							<div class="namebox">
								<?=$product->product_name?>
							</div>
							
						</div>
						
						<div class="pricebox">
							<?php 
								if ($product->price_now < $product->price_init){
									//discounted item
							?>
								<div class="pricebox1_line">
									$<?=$product->price_init?>				
								</div>
								
								<div class="pricebox2">
									$<?=$product->price_now?>				
								</div>
							<?php 
								}
								else{
									//full price item
							?>		
								<div class="pricebox1">
									$<?=$product->price_now?>				
								</div>
							<?php 
								}
							?>
						</div>
						
						<div class="productdetail">
						
							<?=$product->description?>
							
						</div>
						
						<div class="shipping">
							free shipping within Australia
						</div>
						
						
						<a class="shopbutton" href="<?=base_url()?>redirect/<?=$product->sku?>">
							<img src="<?=base_url()?>images/shopthislook.png" border="0" />
						</a>
			
					</div>
					
				</div>
				
			</div>
			<!-- copy from view_popup -- end here -->

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