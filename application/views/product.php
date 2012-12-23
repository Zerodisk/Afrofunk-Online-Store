<html>
<head>
	<?=$css?>
</head>
<body>

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
			
			<a class="shopbutton" href="#">
			</a>
		
		</div>	
</div>


</body>
</html>