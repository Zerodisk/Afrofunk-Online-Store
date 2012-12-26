<html>
	<head>
		<?php echo $head;?>

		<script type="text/javascript">
			var isPopup = false;
		
			$(document).ready(function(){
				$(document).keyup(function(e) {
					  if (e.keyCode == 27) {  // esc (27 = escape key)
						  fnControlProductPopup(false);
					  }   
				});
	
				  
			});
	
			function fnPopItem(sku){
				if (isPopup) {return;}
				$("#popup").load("/store/product/view_popup/" + sku + '/?noCSS=true',function(responseTxt,statusTxt,xhr){
					 if(statusTxt=="success"){
					      //alert("External content loaded successfully!");
						 fnControlProductPopup(true);
					 }
					 if(statusTxt=="error")
					      //alert("Error: "+xhr.status+": "+xhr.statusText);
					      alert('Sorry, there was a problem. Please try again.');
				});
			}
	
			/* ******* popup product ******* */
			function fnControlProductPopup(isDisplay){
				if (isDisplay){
					isPopup = true;
					$('#popup').css('visibility', 'visible');
					$('#container').fadeTo('fast',.3);			//background face out
				}
				else{
					isPopup = false;
					$('#popup').css('visibility', 'hidden');
					$('#container').fadeTo('fast',1);			//backgroud to normal
				}
			}
						
		</script>
		<style>
			#popup{
				position:fixed;
				
				//margin: 0 auto;
				text-align: center ;
				margin-left: auto ;
  				margin-right: auto ;
  				
				max-height:550px;
				top:5px;
				z-index:100;
				overflow:scroll;
				overflow-x:hidden;
			}
		</style>
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