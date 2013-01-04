<script type="text/javascript">
	/* ******* top menu ****** */
	var  timerId=0 ;

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
	
	function clearTimer() {
		if (timerId!=0) {
		    clearTimeout(timerId); timerId=0; 
		}
	}

	function startTimer() {
		  clearTimer(); timerId=setTimeout('timerId=0;hideMenus()',200); 
	}

	function hideMenus(){
		fnMenu('maincatbox',   false);
		fnMenu('mainassbox',   false);
		fnMenu('mainsalebox',  false);
		fnMenu('mainbrandbox', false);
	}
				
</script>

<div id="banner" onclick="window.location.href='/store'" style="cursor:hand">
	<!--  afrofunk logo  -->		
</div>

<div id="nav">
<ul>	
	<li>
		<a href="<?=base_url()?>">HOME</a>			
	</li>
	
	<li>
		<a href="<?=base_url()?>clothing" onmouseover="fnMenu('maincatbox', true)" onmouseout="startTimer()">CLOTHING</a>				
		<div id="maincatbox" onmouseover="fnMenu('maincatbox', true)" onmouseout="startTimer()">
			
			<div class="cattop">
			</div>
			
			<div class="cat">
			
				<div class="cat1">
					
					<div class="catbox">
						<a href="<?=base_url().'clothing/new-arrival'?>" class="deco">
							new arrival
						</a>			
					</div>
					
					<div class="catbox">
						<a href="<?=base_url().'clothing/sales'?>" class="deco">
							sale
						</a>
					</div>
																																
				</div>
				
				<div class="cat2">
				    
					<?php foreach($cat_clothing as $cat){?>
					<div class="catbox">
						<a href="<?=base_url().'clothing/'.url_title(strtolower($cat['category_name']))?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
								
				</div>
				
				<div style="both:clear;">
					&nbsp;&nbsp;	
				</div>
			
			</div>
			
		</div>							
	</li>
	
	<li>
		<a href="<?=base_url()?>accessories" onmouseover="fnMenu('mainassbox', true)" onmouseout="startTimer()">ACCESSORIES</a>	
		<div id="mainassbox" onmouseover="fnMenu('mainassbox', true)" onmouseout="startTimer()">
			
			<div class="cattop">
			</div>
			
			<div class="cat">
			
				<div class="cat1">
					
					<div class="catbox">
						<a href="<?=base_url().'accessories/new-arrival'?>" class="deco">
							new arrival
						</a>			
					</div>
					
					<div class="catbox">
						<a href="<?=base_url().'accessories/sales'?>" class="deco">
							sale
						</a>
					</div>
					
				</div>
				
				<div class="cat2">
					<?php foreach($cat_accessories as $cat){?>
					<div class="catbox">
						<a href="<?=base_url().'accessories/'.url_title(strtolower($cat['category_name']))?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
					
				</div>
			
				<div style="both:clear;">
					&nbsp;&nbsp;	
				</div>
				
			</div>
			
		</div>			
	</li>
	
	<li>
		<a href="<?=base_url()?>brands" onmouseover="fnMenu('mainbrandbox', true)" onmouseout="startTimer()">BRANDS</a>	
		<div id="mainbrandbox" onmouseover="fnMenu('mainbrandbox', true)" onmouseout="startTimer()">
			
			<div class="cattop">
			</div>
			
			<div class="subbrandbox">
				<?php 
				$leftNum = count($brands) % 3;
				$eachNum = intval(count($brands) / 3);
				$max1 = $eachNum;
				$max2 = $eachNum;
				$max3 = $eachNum;
				
				if ($leftNum == 1){
					$max1 = $max1 + 1;
				}
				
				if ($leftNum == 2){
					$max1 = $max1 + 1;
					$max2 = $max2 + 1;
				}
				
				$count = 1;
				?>
			
			
				<div class="brand1">	
				<?php for ($i = $count; $i <= $max1; $i++){?>		
					<div class="catbox">
						<a href="<?=base_url().'brands/'.$brands[$i-1]['brand_url']?>" class="deco">
							<?=$brands[$i-1]['brand']?>
						</a>			
					</div>							
				<?php 
					$count = $count + 1;
				}
				?>
				</div>
				<div class="brand2">			
				<?php for ($i = $count; $i <= $max1+$max2; $i++){?>		
					<div class="catbox">
						<a href="<?=base_url().'brands/'.$brands[$i-1]['brand_url']?>" class="deco">
							<?=$brands[$i-1]['brand']?>
						</a>			
					</div>							
				<?php 
					$count = $count + 1;
				}
				?>						
				</div>
				<div class="brand3">			
				<?php for ($i = $count; $i <= $max1+$max2+$max3; $i++){?>		
					<div class="catbox">
						<a href="<?=base_url().'brands/'.$brands[$i-1]['brand_url']?>" class="deco">
							<?=$brands[$i-1]['brand']?>
						</a>			
					</div>							
				<?php 
					$count = $count + 1;
				}
				?>			
					<div class="catbox">&nbsp;</div>		
				</div>
				
				<div style="both:clear;">
					&nbsp;&nbsp;	
				</div>

			</div>
			
		</div>		
	</li>
	
	<li>
		<a href="<?=base_url()?>sale" onmouseover="fnMenu('mainsalebox', true)" onmouseout="startTimer()">SALE</a>		
		<div id="mainsalebox" onmouseover="fnMenu('mainsalebox', true)" onmouseout="startTimer()">
			
			<div class="cattop">
			</div>
			
			<div class="cat">
			
				<div class="cat1">
					
					<div class="catbox">
						<a href="<?=base_url().'sale/clothing'?>" class="deco">
							clothing
						</a>			
					</div>
					
					<div class="catbox">
						<a href="<?=base_url().'sale/accessories'?>" class="deco">
							accessories
						</a>
					</div>
					
				</div>
				
				<div class="cat2">
					<?php foreach($cat_clothing as $cat){?>
					<div class="catbox">
						<a href="<?=base_url().'sale/'.strtolower($cat['category_name'])?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
					
				</div>
				
				<div style="both:clear;">
					&nbsp;&nbsp;	
				</div>
			
			</div>
			
		</div>				
	</li>
	
	<li>
		<a href="<?=base_url().'aboutus'?>">ABOUTUS</a>			
	</li>
		
</ul>
</div>
