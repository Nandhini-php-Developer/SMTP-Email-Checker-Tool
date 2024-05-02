<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

// require 'vendor/autoload.php';

// $mail = new PHPMailer(true);

// try {
 
//     $mail->isSMTP();
//     $mail->Host = 'ssl://smtp.googlemail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'nsindhudev@gmail.com';
//     $mail->Password = 'rowv yqpo oyip feqo';
//     $mail->Port = 465;
//     $mail->SMTPSecure = 'ssl';

//     // Sender and recipient configuration
//     $mail->setFrom('wpdev1211@gmail.com', 'Test me');
//     $mail->addAddress('wpdev1211@gmail.com', 'test to');

//     // Email content
//     $mail->isHTML(true);
//     $mail->Subject = 'hii this is Goavito mail Test';
//     $mail->Body = 'test';

//     // Send email
//     $mail->send();
//     echo 'Email sent successfully!';
// } catch (Exception $e) {
//     echo 'Error: ' . $mail->ErrorInfo;
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($_POST);exit;
    $mail = new PHPMailer(true);

    try {
        $host = $_POST['host'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $to = $_POST['to'];
        $port = $_POST['port'];
        $secure = $_POST['secure'];

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->Port = $port;
        $mail->SMTPSecure = $secure;

        $mail->setFrom($username);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Test Email from Email Checker';
        $mail->Body = 'This is a test email sent from the Email Checker. If you received this email, it means your email settings are correct.';

        $mail->send();
        $message = 'Email sent successfully!';
    } catch (Exception $e) {
        $message = 'Error: ' . $mail->ErrorInfo;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Checker</title>
    <style>
         body {
            background: linear-gradient(to right, #56ccf2, #2f80ed);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"]
        {
            width: 94%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #f9f9f9;
            color: #333;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        p {
            color: #9E9E9E;
            font-weight: 600;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Checker</h2>
        <p>Test SMTP authentication, send an email, and troubleshoot Email issues in real-time with an SMTP tester.</p>
        <?php if(isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="host">SMTP Host:</label>
            <input type="text" id="host" name="host" placeholder="Enter SMTP Host" required><br><br>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter Password" name="password" required><br><br>
            
            <label for="to">To:</label>
            <input type="email" id="to" name="to" placeholder="Enter Recipient Email" required><br><br>

            <label for="port">Port:</label>
            <input type="number" id="port" name="port" placeholder="Enter Port Number (e.g., 587)" value="587" required><br><br>

            <label for="secure">Encryption:</label>
            <select id="secure" name="secure" required>
                <option value="tls">TLS</option>
                <option value="ssl">SSL</option>
            </select><br><br>
            
            <input type="submit" value="Send Test Email">
        </form>
    </div>
</body>
</html>
