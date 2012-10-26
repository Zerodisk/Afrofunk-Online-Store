<html>
	<head>
		<title><?php echo $product->product_name?></title>
		<?php echo $head;?>
		
		<script>
			$(document).ready( function(){ 
				
			    $(".cb-enable").click(function(){
			        var parent = $(this).parents('.switch');
			        $('.cb-disable',parent).removeClass('selected');
			        $(this).addClass('selected');
			        $('.checkbox',parent).attr('checked', true);

			        if($('.checkbox',parent).attr('ctype')=='photo'){
						var photoId = $('.checkbox',parent).attr('name').replace('photo_', '');
						ajaxUpdatePhotoStatus(photoId, 1);
						alert('set photo id: ' + photoId + ' to enabled');
			        }
			    });
			    $(".cb-disable").click(function(){
			        var parent = $(this).parents('.switch');
			        $('.cb-enable',parent).removeClass('selected');
			        $(this).addClass('selected');
			        $('.checkbox',parent).attr('checked', false);

			        if($('.checkbox',parent).attr('ctype')=='photo'){
						var photoId = $('.checkbox',parent).attr('name').replace('photo_', '');
						ajaxUpdatePhotoStatus(photoId, 0);
						alert('set photo id: ' + photoId + ' to disabled');
			        }
			    });

			    $("input[type=checkbox][id=checkbox][checked]").each(function() {
				    												 	    	var parent = $(this).parents(".switch");
				    												 	    	$(".cb-enable",parent).addClass("selected");
				    												 	    	$(".cb-disable",parent).removeClass("selected");	    
				    												 });
			});

			//make ajax call to set photo's active status
			function ajaxUpdatePhotoStatus(photoId, is_active){
				//block the whole screen - show waiting
				overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
				//submit ajax call

				//if return ok, then un-block screen
				//   else, show error message asking to close this window	

				//remove overlay
				//overlay.remove();			
			}
			
		</script>
	</head>
	<body>
		<form name="frmMain" action="" method="get">
		<div id="photo-list-left">
			<div class="photo-list-box">
		  		<a href="<?php echo $product->image_url;?>" target="_blank"><img src="<?php echo $product->image_url;?>" width="200" border="1" /></a><br>
		  	</div>
		  <?php foreach($photos as $photo){ ?>
		  	 <div class="photo-list-box">
		  	 	<a href="<?php echo $photo['url'];?>" target="_blank"><img src="<?php echo $photo['url'];?>" width="200" border="1" /></a><br>
		  	 	<div class="field switch">
				    <label class="cb-enable"><span>On</span></label>
				    <label class="cb-disable selected"><span>Off</span></label>
				    <input type="checkbox" id="checkbox" class="checkbox" ctype="photo" name="<?php echo 'photo_'.$photo['id'];?>" value="1" <?php if($photo['is_active'] == 1){echo('checked="true"');}?>/>
				</div><br><br>
		  	 </div>
		  <?php }?><br>
		</div>
		
		
		<div id="product-detail-right">
		  status: <br>
			<div class="field switch">
			    <label class="cb-enable"><span>On</span></label>
			    <label class="cb-disable selected"><span>Off</span></label>
			    <input type="checkbox" id="checkbox" class="checkbox" ctype="product" name="is_online" value="1" <?php if($product->is_online == 1){echo('checked="true"');}?>/>
			</div><br><br><br>
		  
		  name:<br>
		  <input type="text" name="product_name" size="100" maxlength="199" value="<?php echo $product->product_name;?>" /><br><br>
		  
		  price (initial)<br>
		  $<input type="text" name="price_init" size="6" value="<?php echo $product->price_init;?>"/> - price (now): $<?php echo $product->price_now;?><br><br>
		  
		  description:<br>
		  <textarea name="description" cols="77" rows="12">
		  	<?php echo $product->description;?>
		  </textarea><br><br>
		  
		  other attribute:<br>
		  <table width="95%" border="1" cellpadding="3" cellspacing="0">
		    <tr>
		  		<td>brand</td>
		  		<td><?php echo $product->brand;?></td>
		  	</tr>
		  	<tr>
		  		<td>colour</td>
		  		<td><?php echo $product->colour;?></td>
		  	</tr>
		  	<tr>
		  		<td>gender</td>
		  		<td><?php echo $product->gender;?></td>
		  	</tr>
		  	<tr>
		  		<td>size</td>
		  		<td><?php echo $product->size;?></td>
		  	</tr>
		  	<tr>
		  		<td>affiliate url</td>
		  		<td><a href="<?php echo $product->url;?>" target="_blank"><?php echo $product->url;?></a></td>
		  	</tr>
		  	<tr>
		  		<td>original url</td>
		  		<td><a href="<?php echo $product->original_url;?>" target="_blank"><?php echo $product->original_url;?></a></td>
		  	</tr>
		  	<tr>
		  		<td>image url</td>
		  		<td><a href="<?php echo $product->image_url;?>" target="_blank"><?php echo $product->image_url;?></a></td>
		  	</tr>
		  	<tr>
		  		<td>delivery cost</td>
		  		<td><?php echo $product->delivery_cost;?></td>
		  	</tr>
		  	<tr>
		  		<td>currency</td>
		  		<td><?php echo $product->currency_code;?></td>
		  	</tr>
		  </table>
		  
		  <input type="submit" value="save">
		</div>
				
		</form>
	</body>
</html>