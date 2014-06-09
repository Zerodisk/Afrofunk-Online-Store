<?php 
$menu = '';
$submenu = '';
$brand = '';

if ($this->uri->total_segments() >= 1){
	$menu = strtolower($this->uri->segment(1));
}

if ($this->uri->total_segments() >= 2){
	$submenu = strtolower($this->uri->segment(2));
	$brand = $this->uri->segment(2);
}

switch($menu){
	case 'clothing':
?>
		<!-- clothing page -->
		<div id="adsblocksmall">
			<div class="adscat">
				<img src="/store/images/clothingbanner.jpg" />
			</div>
		</div>
<?php 
		break;
	case 'accessories':
?>
		<!-- accessories page -->	
		<div id="adsblocksmall">
			<div class="adscat">
				<img src="/store/images/accessoriesbanner.jpg" />
			</div>
		</div>
<?php 
		break;
	case 'brands':
		if ($submenu == ''){
			//main brand
?>
		<!-- brand main page -->
		<div id="adsblocksmall">
			<div class="adsbrand">
				<img src="/store/images/brandbanner.jpg" />
			</div>
		</div>
<?php 
		}
		else{
			//brand specific
?>
 		<!-- brand specific page -->	
		<div id="adsblocksmall">
			<div class="adsbrand">
				<img src="/store/images/brandsbanner/<?=$brand?>.jpg">
			</div>
			<!-- 
			<div class="adsbrandside">
				<?=$brand?>
			</div>
			-->
		</div>
<?php 
		}
		break;	
	case 'sale':
?>
		<!-- sale page -->
		<div id="adsblocksmall">
			<div class="adscat">
				<img src="/store/images/salebanner.jpg" />
			</div>
		</div>		
<?php 
		break;			
	default:	
?>
		<!-- default ads-->
		<div id="adsblock">
			<div id="slidepix">
				<img src="/store/images/bannertop.jpg" />
			</div>
			<div id="ads">		
				<a href="https://track.commissionfactory.com.au/t/6718/3097/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="/store/images/ads-side-1.png" /></a>
				<br>
				<a href="https://track.commissionfactory.com.au/t/6718/3097/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="/store/images/ads-side-2.png" /></a>
			</div>
		</div>
<?php 
}
?>


	

 



		