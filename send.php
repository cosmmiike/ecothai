<?php

if(isset($_POST['submit'])){
    $to = "ecothai@yandex.ru";
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
		$tel = $_POST['tel'];
    $subject = "Форма отправки сообщений с сайта";
    $subject2 = "Copy of your form submission";
    $message = $first_name . "(" . $tel . ") оставил сообщение:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;

    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Сообщение отправлено. Спасибо Вам " . $first_name . ", мы скоро свяжемся с Вами.";
		echo "<br /><br /><a href='https://ecothai.ru'>Вернуться на сайт.</a>";
}

?>
