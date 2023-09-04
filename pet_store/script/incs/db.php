<?php

session_start();

function fetchFromDBLoggedIn() {
	$user = $_SESSION["Name"];
	$dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
	$sth = $dbh->prepare("SELECT * FROM `objects` WHERE clients_name = '$user'");
	$sth->execute();
	$array = $sth->fetchAll(PDO::FETCH_ASSOC);
	return $array;
}

function fetchFromDB() {
	$dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
	$sth = $dbh->prepare("SELECT * FROM `testtable` ORDER BY `name`");
	$sth->execute();
	$array = $sth->fetchAll(PDO::FETCH_ASSOC);
	return $array;
}

function generateCodeBasket($dataArray) {
	$gap = chr(13) . chr(10);
	$generatedCode = "";
	if (empty($dataArray)) {
		$generatedCode = $generatedCode . "<div class=\"product-item\" style=\"
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 10%;
		\">" . $gap;
		$generatedCode = $generatedCode . "<p>Пока у вас в корзине ничего нет.</p>" . $gap;
		$generatedCode = $generatedCode . "</div>" . $gap;
	}
	else {
		foreach ($dataArray as $value) {
			$generatedCode = $generatedCode . "<div class=\"product-item\">" . $gap;
			$generatedCode = $generatedCode . "<img src=\"" . $value['src'] . "\">" . $gap;
			$generatedCode = $generatedCode . "<div class=\"product-list\">" . $gap;
			$generatedCode = $generatedCode . "<h3>" . $value['order_name'] . "</h3>" . $gap;
			$generatedCode = $generatedCode . "<span class=\"price\">" . $value['price'] . "</span>" . $gap;
			$generatedCode = $generatedCode . "<a href=\"card.php\" class=\"button\">Купить</a>" . $gap;
			$generatedCode = $generatedCode . "<a href=\"delete_item.php?name=" . $value['order_name'] . "\" class=\"button_del\">Удалить</a>" . $gap;
			$generatedCode = $generatedCode . "</div>" . $gap . "</div>" . $gap;
		}
	}
	return $generatedCode;
}

function generateCodeNotLogged($dataArray) {
	$gap = chr(13) . chr(10);
	$generatedCode = "";
	foreach ($dataArray as $value) {
		$generatedCode = $generatedCode . "<div class=\"product-item\">" . $gap;
		$generatedCode = $generatedCode . "<img src=\"" . $value['src'] . "\">" . $gap;
		$generatedCode = $generatedCode . "<div class=\"product-list\">" . $gap;
		$generatedCode = $generatedCode . "<h3>" . $value['name'] . "</h3>" . $gap;
		$generatedCode = $generatedCode . "<span class=\"price\">" . $value['price'] . "</span>" . $gap;
		$generatedCode = $generatedCode . "<a href=\"../script/registrationLogin.php?switch=true\" class=\"button\">В корзину</a>" . $gap;
		$generatedCode = $generatedCode . "</div>" . $gap . "</div>" . $gap;
	}
	return $generatedCode;
}

function generateCode($dataArray) {
	$gap = chr(13) . chr(10);
	$generatedCode = "";
	foreach ($dataArray as $value) {
		$generatedCode = $generatedCode . "<div class=\"product-item\">" . $gap;
		$generatedCode = $generatedCode . "<img src=\"" . $value['src'] . "\">" . $gap;
		$generatedCode = $generatedCode . "<div class=\"product-list\">" . $gap;
		$generatedCode = $generatedCode . "<h3>" . $value['name'] . "</h3>" . $gap;
		$generatedCode = $generatedCode . "<span class=\"price\">" . $value['price'] . "</span>" . $gap;
		$generatedCode = $generatedCode . "<a href=\"add_item.php?src=" . $value['src'] . "&name=" . $value['name'] . "&value=" . $value['price'] . "\" class=\"button\">В корзину</a>" . $gap;
		$generatedCode = $generatedCode . "</div>" . $gap . "</div>" . $gap;
	}
	return $generatedCode;
}

