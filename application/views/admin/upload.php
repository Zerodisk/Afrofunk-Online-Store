<html>
<head>
<title>Upload photo</title>
</head>
<body>

<?php 
if ($is_error) {
	echo $error;
}
else{
?>
	<?php if ($is_success){?>
		photo upload success, file URL is<br>
		<form>
		   <textarea cols="50" rows="3"><?php echo(base_url().'images/my/'.$file_name)?></textarea><br>
		   <input type="button" value="close" onclick="self.close();" />
		</form>
	<?php }
	      else{
	?>
	<form method="post" action="../doUpload/?sku=<?php echo($product->sku)?>" enctype="multipart/form-data" />
	    upload photo for: <b><?php echo($product->product_name)?></b><br><br>
		<input type="hidden" name="sku" value="<?php echo($product->sku)?>" />
	
		<input type="file" name="userfile" size="20" /><br /><br />
						
		<input type="submit" value="upload" />
	
	</form>
	<?php }?>

<?php }?>

</body>
</html>