<?php
require_once __DIR__ . '/incs/db.php';

$dataArray = fetchFromDBLoggedIn();
$products = generateCodeBasket($dataArray);

$main_template = file_get_contents("../html/index.html");
$main_template= str_replace(
	'{header}',
	file_get_contents('../html/header3.html'), 
	$main_template);
$main_template= str_replace(
	'{footer}',
	file_get_contents('../html/footer.html'), 
	$main_template);
$main_template= str_replace(
	'{products}',
	$products, 
	$main_template);

echo $main_template;