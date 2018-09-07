<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        if ($email === "") {
          $email = filter_var(trim("nomail@ecothai.ru"), FILTER_SANITIZE_EMAIL);
        }
        $tel = trim($_POST["tel"]);
        $message = trim($_POST["message"]);
        $date = date('Y-m-d H:i:s');

        $servername = "localhost";
        $username = "cb80943_ecothai";
        $password = "vvmqk9M0";
        $dbname = "cb80943_ecothai";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO opt_client (Name, Email, Tel, Reason, Date_Added)
        VALUES ('$name', '$email', '$tel', '$message', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Упс! Что-то пошло не так. Попробуйте еще раз отправить заявку.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "opt@ecothai.ru";

        // Set the email subject.
        $subject = "Запрос прайса от $name";

        // Build the email content.
        $email_content = "Имя: $name\n";
        $email_content .= "Телефон: $tel\n";
        $email_content .= "E-mail: $email\n\n";
        $email_content .= "Чем занимается:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Спасибо! Ваша заявка отправлена.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Упс! Что-то пошло не так. Попробуйте еще раз отправить заявку.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Упс! Что-то пошло не так. Попробуйте еще раз отправить заявку.";
    }

?>
