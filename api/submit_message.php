<?php
// submit_message.php

include 'includes/db_connect.php';
require_once 'mail/sendmail.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name'], $data['email'], $data['message'])) {
    $name = $data['name'];
    $email = $data['email'];
    $message = $data['message'];
	
	if (!isset($_COOKIE['user_token'])) {
		$token = bin2hex(random_bytes(16));
		setcookie('user_token', $token, time() + (86400 * 30), "/"); // Expires in 30 days
	} else {
		$token = $_COOKIE['user_token'];
	}

    $sql = "INSERT INTO employee_messages (name, email, message, user_token) VALUES (:name, :email, :message, :user_token)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
	$stmt->bindParam(':user_token', $token);
    if ($stmt->execute()) {
        $insertId = $pdo->lastInsertId();
		echo json_encode(['success' => true, 'insert_id' => $insertId]);
		$mailer = new Mailer();
		$Subject = 'מודעתך פורסמה בהצלחה!';
		$template = file_get_contents('mail/email_template.html');
		$template = str_replace('{{name}}', $name, $template);
		$template = str_replace('{{reference_number}}', $insertId, $template);
		$mailer->sendMail($email, $name, $Subject, $template);
    } else {
        echo json_encode(['success' => false, 'error' => 'שגיאה בהוספת ההודעה']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'חסרים נתונים']);
}
?>
