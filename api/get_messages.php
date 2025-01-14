<?php
// get_messages.php
include 'includes/db_connect.php';


if (isset($_COOKIE['user_token'])) {
	$token = $_COOKIE['user_token'];
}
	
	
$sql = "SELECT id, message, name, email, DATE_FORMAT(created_at, '%d/%m/%Y - %H:%i') AS formatted_date, user_token FROM employee_messages ORDER BY id DESC";
$stmt = $pdo->query($sql);

$messages = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	if($row['user_token'] !== $token) {
		$row['user_token'] = null;
	}
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);
?>
