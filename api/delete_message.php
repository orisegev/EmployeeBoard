<?php
// delete_message.php
include 'includes/db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['message_id'])) {
    $messageId = $data['message_id'];

    if (!isset($_COOKIE['user_token'])) {
        echo json_encode(['success' => false, 'error' => 'Token missing']);
        exit;
    }

    $userToken = $_COOKIE['user_token'];

    $sql = "SELECT id FROM employee_messages WHERE id = :message_id AND user_token = :user_token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':message_id', $messageId);
    $stmt->bindParam(':user_token', $userToken);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $deleteSql = "DELETE FROM employee_messages WHERE id = :message_id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':message_id', $messageId);

        if ($deleteStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete message']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Token mismatch or message not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Message ID missing']);
}
?>
