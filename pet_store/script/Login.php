<?php
require 'send.php';

session_start();

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
	$sth = $dbh->prepare("SELECT * FROM users WHERE email = '$email'");
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

    //May cause ERROR
    if (!checkUser() && ($email == $result[0]['email']) && ($password == $result[0]['password'])){
        $_SESSION['Name'] = $email;
        // идем на страницу для авторизованного пользователя
        header('Location: index.php');
        exit();
    }
    else{
        $currentURL = 'http://ant_polovoy/testing/script/registrationLogin.php?switch=true';
        $x = file_get_contents($currentURL);
        $x= str_replace(
			'<span></span>', 
			'<span style="font-size: 120%; color: red; margin-left: 15%;">Invalid email or password!</span>', 
			$x);
        echo $x;
    }

}
?>