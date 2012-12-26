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
			
					<div class="xbox" onclick="fnControlProductPopup(false)">
							
					</div>
					
					<div id="photobox">
						
						<div id="mainphoto">
							<img src="<?=$product->image_url?>" width="351">
						</div>
					
						<div id="subphoto">
							<?php
							$i = 1; 
							foreach($photos as $photo){
							?>
							<div class="photo<?=$i?>">
								<img src="<?=$photo['url']?>" width="108">
							</div>
							<?php
								$i = $i + 1; 
							}
							?>
						</div>
						
					</div>
					
					<div class="productdes">
					
						<div class="brandbox">
							<?=$product->brand?>		
						</div>
						
						<div class="namebox">
							<?=$product->product_name?>
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
						
					</div>
					
					<div class="buttonblock">
						
						<div class="shipping">
							free shipping
						</div>
						
						<a class="shopbutton" href="<?=base_url()?>redirect/<?=$product->sku?>">
						</a>
					
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