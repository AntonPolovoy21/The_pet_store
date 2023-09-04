<?php

session_start();

if (isset($_GET['name'])) {
    
    $name = $_GET['name'];
    $dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
	$sth = $dbh->prepare("DELETE FROM testdb.objects WHERE order_name = :name AND clients_name = :clients_name");
    $sth->bindParam(':name', $name);
    $sth->bindParam(':clients_name', $_SESSION['Name']);
	$sth->execute();

    header('Location: basket.php');
    exit();
} else {

    echo "Die Badddd!!";
}
?>