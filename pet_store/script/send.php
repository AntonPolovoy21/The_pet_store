<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

function checkUser()
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbh = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', '1234');
	$sth = $dbh->prepare("SELECT * FROM users WHERE email = '$email'");
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

    $flag = FALSE;
    foreach ($result as $value) {
        if ($value['email'] == $email) {
            $flag = TRUE;
            break;
        }
    }
    if ($flag) {
        return FALSE;
    }
    
    $sth = $dbh->prepare("INSERT INTO users (email, password) VALUES ('$email', '$password')");
	$sth->execute();
    return TRUE;
}

function sendEmail($data) {

    if (!error_get_last()) {
        $email = $data['email']['value'];
        $text = "С нашими питомцами вам никогда не будет скучно";
        
        $title = "Поздравляем с регистрацией на нашем сайте!!!";
        $body = "
        <h2>Благодарим за регистрацию!</h2>
        <b>Имя:</b> Пользователь сайта dogs.com<br>
        <b>Почта:</b> $email<br><br>
        <b>Сообщение:</b><br>$text
        ";
        
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        
        $mail->isSMTP();   
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth   = true;
        $mail->Debugoutput = function($str, $level) {$GLOBALS['data']['debug'][] = $str;};
        
        $mail->Host       = 'smtp.gmail.com'; //Server-address
        $mail->Username   = 'denisenkoroman2016@gmail.com'; //Sender login
        $mail->Password   = 'mnewesycikyzibnt'; //Session password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('denisenkoroman2016@gmail.com', 'Hello'); // Адрес самой почты и имя отправителя
        
        //Receiver
        $mail->addAddress($email);  
    
        //Send mail
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $body;    
        
        // Проверяем отправленность сообщения
        $mail->send();
    } else {
        echo "so bad";
    }
}

?>