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
				<img src="/store/images/newyear.jpg" />
			</div>
			<div id="ads">		
				<a href="https://track.commissionfactory.com.au/b/6718/10175/women/special-price/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/a272e586-baf4-4649-8c97-075906cb1e34.gif" /></a>
				<br><br>
				<a href="https://track.commissionfactory.com.au/b/6718/9139/women/clothing/new-products/?sort=popularity&amp;dir=desc" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/b04260b9-88e1-4106-9f31-ca13a1e0f61e.gif" /></a>
			</div>
		</div>
<?php 
}
?>


	

 



		