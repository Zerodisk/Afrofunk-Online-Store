<div id="banner" onclick="window.location.href='/store'" style="cursor:hand">
	<!--  afrofunk logo  -->		
</div>

<ul id="nav">
	
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
						<a href="<?=base_url().'clothing'?>" class="deco">
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
						<a href="<?=base_url().'clothing/'.strtolower($cat['category_name'])?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
					
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
						<a href="<?=base_url().'accessories'?>" class="deco">
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
						<a href="<?=base_url().'accessories/'.strtolower($cat['category_name'])?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
					
				</div>
			
			</div>
			
		</div>			
	</li>
	
	<li>
		<a href="<?=base_url()?>brands">BRANDS</a>			
	</li>
	
	<li>
		<a href="<?=base_url()?>sales" onmouseover="fnMenu('mainsalebox', true)" onmouseout="startTimer()">SALE</a>		
		<div id="mainsalebox" onmouseover="fnMenu('mainsalebox', true)" onmouseout="startTimer()">
			
			<div class="cattop">
			</div>
			
			<div class="cat">
			
				<div class="cat1">
					
					<div class="catbox">
						<a href="<?=base_url().'clothing'?>" class="deco">
							clothing
						</a>			
					</div>
					
					<div class="catbox">
						<a href="<?=base_url().'accessories'?>" class="deco">
							accessories
						</a>
					</div>
					
				</div>
				
				<div class="cat2">
					<?php foreach($cat_clothing as $cat){?>
					<div class="catbox">
						<a href="<?=base_url().'clothing/'.strtolower($cat['category_name'])?>" class="deco">
							<?=$cat['category_name']?>
						</a>
					</div>
					<?php }?>
					
				</div>
			
			</div>
			
		</div>				
	</li>
	
	<li>
		<a href="<?=base_url().'aboutus'?>">ABOUTUS</a>			
	</li>
		
</ul>

