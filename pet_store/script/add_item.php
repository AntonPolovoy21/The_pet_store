<?php
session_start();

if (isset($_GET['name']) && isset($_GET['src']) && isset($_GET['value'])) {
    
    $name = $_GET['name'];
    $src = str_replace('\\', '\\\\', $_GET['src']);
    $price = $_GET['value'];
    $client_name = $_SESSION['Name'];
    $dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
    $sth = $dbh->prepare("INSERT INTO objects (order_name, price, src, clients_name) VALUES ('$name', '$price', '$src', '$client_name')");
    $sth->execute();

    header('Location: index.php');
    exit();
}
else {
    echo "Die Badddd!!"; 
}
?>