<html>
<head>

	<meta http-equiv="Content-Type" content="text/html" />
	
	<meta name="description" content="Australia best online affiliate fashion and footwear store. Funky and Streetware style with the trendiest brands. Buy clothes online, shoes online, 
	and fashion accessories." />
	
	<meta name="keywords" content="Funky Fashion Accessories, Streetware vision, Designer clothes women, Women designer clothes, Ladies Fashion accessories" />
	
	<meta name="geo.region" content="AU-NSW" />
	<meta name="rating" content="general" />
	<meta name="language" content="English" />
	<meta name="robots" content="index,follow" />

	<?php echo $head;?>
	
	<title>Afrofunk Clothing Sydney</title>

	<script type="text/javascript">
		var isPopup = false;		//indicate popup - true: product is popup now, false: not popup
		var isPopMouseIn = false;	//indicate is mouse is over/in the product popup - true: moust is over/in now
	
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
				$('#popup').css('left', ((self.innerWidth - 810)/2) + 'px');
				$('#popup').css('top', ((self.innerHeight - 550)/2) + 'px');
				$('#popup').css('visibility', 'visible');
				$('#container').fadeTo('fast',.3);			//background face out

			}
			else{
				isPopup = false;
				$('#popup').css('visibility', 'hidden');
				$('#container').fadeTo('fast',1);			//backgroud to normal
			}
		}

		function fnSetPopupMouseValue(value){
			isPopMouseIn = value;
		}

		function fnBody_OnClick(){
			if (!isPopMouseIn){
				fnControlProductPopup(false);
			}
		}
					
	</script>
	<style>
			#popup{
				position:fixed;
				
				margin: 0 auto;
				text-align: center ;
				margin-left: auto ;
  				margin-right: auto ;
  				
				max-height:560px;
				top:5px;
				z-index:100;
				//overflow:scroll;
				overflow-x:hidden;
				overflow-y:hidden;
			}
		</style>
</head>
<body onclick="fnBody_OnClick()">
	<div id="popup" onmouseover="fnSetPopupMouseValue(true)" onmouseout="fnSetPopupMouseValue(false)"></div>
	<div id="container">

		<?php echo $header;?>
 
 <!-- 
		<div class="smallbox">
	
		</div>
-->
		
		<?php echo $ads;?>

		<div id="products">
		
			<div class="navigatebox">
				<?=$nav_html?>
			</div>
			
			<?php foreach($products as $product){?>
			<div class="block float">
			
				<div class="photoblock">
				    <?php
				    if ($show_product_as_popup){
						//use lazy load only selected browser same way it's allowed popup product
						//use javascript to popup product
					?>
						<a href="javascript:fnPopItem('<?=$product['sku']?>')"><img src="<?=base_url()?>images/grey.gif" data-original="<?=$product['image_url']?>" width="185" border="0" /></a>
					<?php 
					}
					else{
						//for IE and Mobile client
					?>
						<a href="/store/product/view/<?=$product['sku']?>"><img src="<?=$product['image_url']?>" width="185" border="0" /></a>
					<?php }?>
				</div>
				
				<div class="brandblock">
					<a class="brandfont" href="<?=base_url()?>brands/<?=url_title($product['brand'])?>"><?=$product['brand']?></a>
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
			
			<div class="itempage">
				<?=count($products)?> ITEMS FOUND
			</div>

		</div>
		
   	    <br>
	    <?php echo $footer;?>		

	</div>
  <script src="<?=base_url()?>js/lazyload.js" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
      $(function() {
          $("img").lazyload();
      });

      /*
      need to change from
      <img src="<?=$product['image_url']?>" width="185" />
      to
      <img src="<?=base_url()?>images/grey.gif" data-original="<?=$product['image_url']?>" width="185" />
      */
  </script>
</body>
</html>