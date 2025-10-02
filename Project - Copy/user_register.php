<?php
session_start();
$host='localhost'; $user='root'; $pass=''; $db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');

$msg = '';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'],$_POST['password'],$_POST['name'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, name, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $email, $name, $password);
    if($stmt->execute()) {
        $msg = "Registration successful. <a href='user_login.php'>Login here</a>";
    } else {
        $msg = "Registration failed. Email may already exist.";
    }
    $stmt->close();
}
?>
<!doctype html>
<html><head><title>Register</title></head>
<body>
<h2>User Registration</h2>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
<div><?php echo $msg; ?></div>
<p>Already have an account? <a href='user_login.php'>Login here</a></p>
</body></html>
