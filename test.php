<?php
date_default_timezone_set('Australia/NSW');
echo date('Y-m-d H:i:s');

$includeParam = array('sku','product_name','description','url','original_url','image_url','price','delivery_cost','currency_code','brand','colour','gender','size');
if (in_array('product_name ', $includeParam)) {
	echo('found it');
}
else{
	echo('not found!');
}


try {
	$i = 1/0;
}
catch (Exception $e) {
	echo('Caught exception: '.$e->getMessage());
}

//echo phpinfo(); 



//echo file_get_contents("http://www.google.com");




