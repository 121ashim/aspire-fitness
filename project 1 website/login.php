<?php
$email = $_POST['email'];
$password = $_POST['password'];

$con = new mysqli("localhost", "root", "", "website");
if ($con->connect_error) {
    die("failed to connect : " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email); // Fixed the typo here (bind_paam should be bind_param)
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) { // Fixed the typo here (num rows should be num_rows)
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            header("Location: shedule.html");
            
        } else {
            echo "<h2>Invalid email or password</h2>";
        }
    } else {
        echo "<h2>Invalid email or password</h2>";
    }
}
?>
