<?php
// get_messages.php
include 'includes/db_connect.php';

$sql = "SELECT id, message, name, email, DATE_FORMAT(created_at, '%d/%m/%Y - %H:%i') AS formatted_date, user_token FROM employee_messages ORDER BY id DESC";
$stmt = $pdo->query($sql);

$messages = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);
?>
