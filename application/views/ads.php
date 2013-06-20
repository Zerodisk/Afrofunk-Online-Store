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
				<a href="https://track.commissionfactory.com.au/b/6718/12025/aff_c" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/3222eb0a-3271-46e0-b044-0131926cda7c/a55e4eec-e845-4417-9d90-a3c21223bb80.jpg" /></a>
				<br><br>
				<!-- <a href="https://track.commissionfactory.com.au/b/6718/10492/women/womens-bags/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/9673a31f-bc05-4cc4-af60-e397038846fc.gif" /></a> -->
				<a href="https://track.commissionfactory.com.au/b/6718/10963/women/clothing/coats-and-jackets/" rel="noindex,nofollow"><img style="border: none; vertical-align: middle;" alt="" src="http://content.commissionfactory.com.au/Banners/9f772a1f-b8f6-4ccb-94b6-607ffa8e72a5/250edc51-d64b-4ec4-9f21-278457c47298.gif" /></a>
			</div>
		</div>
<?php 
}
?>


	

 



		