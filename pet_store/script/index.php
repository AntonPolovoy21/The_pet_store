<?php

require_once __DIR__ . '/incs/db.php';

$dataArray = fetchFromDB();

if (isset($_SESSION['Name'])) {
	$products = generateCode($dataArray);
}
else {
	$products = generateCodeNotLogged($dataArray);
}

if (isset($_SESSION['Name'])) {
	$main_template = file_get_contents("../html/index.html");

	$main_template= str_replace(
		'{header}', 
		file_get_contents('../html/header2.html'), 
		$main_template);

	$main_template= str_replace(
		'{footer}',
		file_get_contents('../html/footer.html'), 
		$main_template);

	$main_template= str_replace(
		'{products}', 
		$products, 
		$main_template);
}
else {
	$main_template = file_get_contents("../html/index.html");

	$main_template= str_replace(
		'{header}', 
		file_get_contents('../html/header.html'), 
		$main_template);

	$main_template= str_replace(
		'{footer}',
		file_get_contents('../html/footer.html'), 
		$main_template);

	$main_template= str_replace(
		'{products}', 
		$products, 
		$main_template);
}

echo $main_template;