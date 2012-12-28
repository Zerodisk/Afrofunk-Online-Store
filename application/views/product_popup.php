<html>
<head>
</head>
<body>

 
	<div id="containerPopup">
		
		<div class="xbox" onclick="fnControlProductPopup(false)">
		
		</div>
		
		<div id="photobox">
		
			<div id="mainphoto">
				<img width="351" id="mainImage">
			</div>
			
			<div id="subphoto">
				<div class="photo1">
					<img width="108" id="image1" onmouseover="fnImageSwitch(this)">
				</div>
				
				
				<?php if (count($photos) >= 1){?>
				<div class="photo2">
					<img width="108" id="image2" onmouseover="fnImageSwitch(this)" />
				</div>
				<?php }?>
				
				
				<?php if (count($photos) >= 2){?>
				<div class="photo3">
					<img width="108" id="image3" onmouseover="fnImageSwitch(this)" />
				</div>
				<?php }?>
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
				
				<div class="shopbutton">
					<a href="<?=base_url()?>redirect/<?=$product->sku?>">
						<img src="<?=base_url()?>images/shopthislook.png" border="0" />
					</a>
				</div>
		
			</div>
			
		</div>
		
	</div>
	
	<script type="text/javascript">
		function fnImageSwitch(img){
			$('#mainImage').attr("src", img.src);
		}
						
		img1 = new Image();
		img1.src = "<?=$product->image_url?>";
		$('#mainImage').attr("src", img1.src);
		$('#image1').attr("src", img1.src);
	
		<?php 
		$i = 2;
		foreach ($photos as $photo){
			echo('img'.$i.' = new Image();'."\n");
			echo('img'.$i.'.src = "'.$photo['url'].'";'."\n");
			echo('$("#image'.$i.'").attr("src", img'.$i.'.src);'."\n");
			
			$i = $i + 1;
		}
		?>
	</script>

</body>
</html>