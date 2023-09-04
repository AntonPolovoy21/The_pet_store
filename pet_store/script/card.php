<?php

session_start();

$card_template = file_get_contents("../html/card.html");

if (isset($_SESSION['Name'])) {
	$card_template= str_replace(
		'{header}', 
		file_get_contents('../html/header2.html'), 
		$card_template);
	
		$card_template= str_replace(
		'{footer}', 
		file_get_contents('../html/footer.html'), 
		$card_template);
}
else {
	$card_template= str_replace(
		'{header}', 
		file_get_contents('../html/header.html'), 
		$card_template);
	
		$card_template= str_replace(
		'{footer}', 
		file_get_contents('../html/footer.html'), 
		$card_template);
}

echo $card_template;