<html>
<head>

	<meta http-equiv="Content-Type" content="text/html" />
	
	<meta name="description" content="Buy <?=$product->brand?>, <?=$product->product_name?> online at Afro Funk Clothing, Australia best online affiliate fashion and footwear store. Funky and Streetware style with the trendiest brands. Buy clothes online, shoes online, 
	and fashion accessories." />
	
	<meta name="keywords" content="<?=$product->brand?>, <?=$product->product_name?>, Funky Fashion Accessories, Streetware vision, Designer clothes women, Women designer clothes, Ladies Fashion accessories" />
	
	<meta name="geo.region" content="AU-NSW" />
	<meta name="rating" content="general" />
	<meta name="language" content="English" />
	<meta name="robots" content="index,follow" />

	<?php echo $head;?>
	
	<title><?=$product->brand?> | <?=$product->product_name?> | Afrofunk Clothing Sydney</title>
	
</head>
<body>
	<div id="container">

		<?php echo $header;?>
		<!-- 
		<div class="smallbox">
	
		</div>
		-->
		
		<div id="products">
			<br><br>
		
		    <!-- copy from view_popup -- start here -->
				<div id="containerPopup">
					
					<br>
					
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
							    <?php if ($product->mid == '100') {echo('free shipping within Australia');}?>
			
								<?php if ($product->mid == '101') {echo('free shipping within Australia');}?>
															
								<?php if ($product->mid == '102') {echo('free shipping on $50 or more');}?>
							</div>
							
							<a class="shopbutton" href="<?=base_url()?>redirect/<?=$product->sku?>">
								<img src="<?=base_url()?>images/shopthislook.png" border="0" />
							</a>
					
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