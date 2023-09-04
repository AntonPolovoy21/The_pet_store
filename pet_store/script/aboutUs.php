<?php

session_start();

$aboutUs_template = file_get_contents("../html/shop.html");

if (isset($_SESSION['Name'])) {
	$aboutUs_template= str_replace(
		'{header}', 
		file_get_contents('../html/header2.html'), 
		$aboutUs_template);
	
		$aboutUs_template= str_replace(
		'{footer}', 
		file_get_contents('../html/footer.html'), 
		$aboutUs_template);
}
else {
	$aboutUs_template= str_replace(
		'{header}', 
		file_get_contents('../html/header.html'), 
		$aboutUs_template);
	
		$aboutUs_template= str_replace(
		'{footer}', 
		file_get_contents('../html/footer.html'), 
		$aboutUs_template);
}

echo $aboutUs_template;