<?php
// ----------------------- PHP MAILER PART -----------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$sent_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'oussama.ouakmour@gmail.com'; 
        $mail->Password   = 'TON_MOT_DE_PASSE_APPLICATION';  
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender
        $mail->setFrom('oussama.ouakmour@gmail.com', 'Portfolio Contact');

        // Receiver
        $mail->addAddress('oussama.ouakmour@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "📩 Nouveau Message depuis ton Portfolio";
        $mail->Body = "
            <h2>Nouveau Message</h2>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $mail->send();
        $sent_message = "Message envoyé avec succès !";

    } catch (Exception $e) {
        $error_message = "Erreur : message non envoyé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact Me</title>

  <style>
    body {
      background: #0f1624;
      font-family: Arial, sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      padding-top: 60px;
    }

    .contact-box {
      background: rgba(255,255,255,0.05);
      padding: 30px;
      border-radius: 12px;
      width: 420px;
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
    }

    h2 {
      text-align: center;
      background: linear-gradient(90deg, #00d4ff, #5a7dff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 26px;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .input-box {
      margin-bottom: 15px;
    }

    .input-box label {
      display: block;
      margin-bottom: 5px;
      font-size: 14px;
      color: #bfc5d2;
    }

    .input-box input, .input-box textarea {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.04);
      color: white;
      font-size: 15px;
      outline: none;
      transition: 0.3s;
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(90deg, #6a8dff, #00d4ff);
      border: none;
      border-radius: 30px;
      font-size: 17px;
      color: white;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 600;
    }
    .btn:hover { opacity: 0.8; }

    .msg-success, .msg-error {
      text-align: center;
      margin-top: 12px;
      padding: 10px;
      border-radius: 8px;
    }
    .msg-success {
      background: rgba(0,255,170,0.15);
      color: #00ffae;
    }
    .msg-error {
      background: rgba(255,0,0,0.15);
      color: #ff7b7b;
    }
  </style>
</head>

<body>

  <div class="contact-box">
    <h2>Contact Me</h2>

    <?php if ($sent_message): ?>
      <div class="msg-success"><?= $sent_message ?></div>
    <?php endif; ?>

    <?php if ($error_message): ?>
      <div class="msg-error"><?= $error_message ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="input-box">
        <label>Name</label>
        <input type="text" name="name" required>
      </div>

      <div class="input-box">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="input-box">
        <label>Message</label>
        <textarea name="message" rows="5" required></textarea>
      </div>

      <button class="btn">SEND</button>
    </form>
  </div>

</body>
</html>
