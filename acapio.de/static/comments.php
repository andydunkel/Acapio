<?php
header('Content-Type: application/json');
include("config.php");

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the real IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP']; // IP from shared internet
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; // IP from proxy
    } else {
        return $_SERVER['REMOTE_ADDR']; // Direct IP
    }
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    global $conf_ip_lock_time;
    $post_id = $_POST['post_id'];
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);
    $ip      = getUserIP();
    $rate_limit_seconds = $conf_ip_lock_time;

    if (empty($name) || empty($email) || empty($comment)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT created_at FROM comments WHERE ip_address = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($last_comment_time);
        $stmt->fetch();
        $stmt->close();

        $time_since_last_comment = time() - strtotime($last_comment_time);
        if ($time_since_last_comment < $rate_limit_seconds) {
            echo json_encode(["success" => false, "message" => "You're posting too quickly! Please wait " . ($rate_limit_seconds - $time_since_last_comment) . " seconds."]);
            exit;
        }
    } else {
        $stmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO comments (post_id, name, email, comment, ip_address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $post_id, $name, $email, $comment, $ip);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["success" => true, "message" => "Comment submitted!"]);
}


// Fetch comments for a specific post (without exposing IPs)
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $stmt = $conn->prepare("SELECT name, comment, created_at FROM comments WHERE post_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row; // IP is NOT included in the output
    }

    echo json_encode($comments);
}
?>
