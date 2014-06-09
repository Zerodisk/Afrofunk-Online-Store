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
<<<<<<< HEAD
				<a href="https://track.commissionfactory.com.au/t/6718/3097/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="/store/images/ads-side-1.png" /></a>
				<br>
				<a href="https://track.commissionfactory.com.au/t/6718/3097/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="/store/images/ads-side-2.png" /></a>
=======
				<!-- <a href="https://track.commissionfactory.com.au/b/6718/12025/aff_c" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/3222eb0a-3271-46e0-b044-0131926cda7c/a55e4eec-e845-4417-9d90-a3c21223bb80.jpg" /></a>  -->
				<a href="https://track.commissionfactory.com.au/b/6718/14154/boutique/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/56da36ec-3bdf-4455-a619-74011b8e20f6.gif" /></a>
				<br><br>
				
				
				<!-- <a href="https://track.commissionfactory.com.au/b/6718/13676/sass-bide/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/a63e35a4-a0f9-496c-80d0-ef021cafcd69.jpg" /></a> -->
				<a href="https://track.commissionfactory.com.au/b/6718/13682/siren/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/21fd9853-a300-4cca-bf27-2e2f62050d76.jpg" /></a>
>>>>>>> 36b12152920f92bcb77705042cd682413d6983e1
			</div>
		</div>
<?php 
}
?>


	

 



		