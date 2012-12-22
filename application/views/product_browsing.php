<html>
	<head>
		<?php echo $head;?>

		<script type="text/javascript">
			$(document).ready(function(){
				
	
				  
			});
	
			function fnPopItem(sku){
				$("#popup").load("product/view/" + sku,function(responseTxt,statusTxt,xhr){
					 if(statusTxt=="success")
					      alert("External content loaded successfully!");
					 if(statusTxt=="error")
					      alert("Error: "+xhr.status+": "+xhr.statusText);
				});
			}
	
			function fnMenu(menuName, isDisplay){
				if (isDisplay){
					clearTimer();
					hideMenus()
					$('#'+menuName).css('visibility', 'visible');
				}
				else{
					$('#'+menuName).css('visibility', 'hidden');
				}
			}
	
			/* ******* top menu ****** */
			var  timerId=0 ;
			
			function clearTimer() {
				if (timerId!=0) {
				    clearTimeout(timerId); timerId=0; 
				}
			}
	
			function startTimer() {
				  clearTimer(); timerId=setTimeout('timerId=0;hideMenus()',200); 
			}
	
			function hideMenus(){
				fnMenu('maincatbox', false);
				fnMenu('mainassbox', false);
				fnMenu('mainsalebox', false);
			}
						
		</script>
</head>
<body>

<div id="popup"></div>



	<div id="container">

		<?php echo $header;?>

		<div class="smallbox">
	
		</div>
			
		<?php echo $ads;?>

		<div id="products">
		
			<div class="navigatebox">
				<?=$nav_html?>
			</div>
			
			<?php foreach($products as $product){?>
			<div class="block float">
			
				<div class="photoblock">
					<a href="javascript:fnPopItem('<?=$product['sku']?>')"><img src="<?=$product['image_url']?>" width="185" /></a>
				</div>
				
				<div class="brandblock">
					<?=$product['brand']?>
				</div>
				
				<div class="nameblock">
					<?=$product['product_name']?>
				</div>
				<?php 
				if ($product['price_now'] < $product['price_init']){
					//discounted item
				?>
					<div class="priceblock1_line priceblock_font">
						$<?=$product['price_init']?>
					</div>
					
					<div class="priceblock2 priceblock_font">
						$<?=$product['price_now']?>
					</div>
				<?php }
				else{
					//full price item
				?>
					<div class="priceblock1 priceblock_font">
						$<?=$product['price_now']?>
					</div>
				<?php 
				}
				?>
							
			</div>
			<?php }?>
			
			
			<!--  sample product box 
			<div class="block float">		
				<div class="photoblock"></div>			
				<div class="brandblock">sample brand</div>				
				<div class="nameblock">sample product name</div>				
				<div class="priceblock1">$89.00</div>				
				<div class="priceblock2">$49.00</div>							
			</div>
			-->
			
			
			<div class="space">
			
			</div>
			
			<div class="itemfound">
				<?=count($products)?> ITEMS FOUND
			</div>

		</div>
		
    <br>
	<?php echo $footer;?>		


		
	</div>

</body>
</html>