<?php
session_start();
$host='localhost'; $user='root'; $pass=''; $db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');

$msg = '';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'],$_POST['password'])){
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $name, $hash);
        $stmt->fetch();
        if(password_verify($_POST['password'], $hash)){
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header('Location: profile.php');
            exit;
        } else {
            $msg = "Incorrect password.";
        }
    } else {
        $msg = "No user found.";
    }
    $stmt->close();
}
?>
<!doctype html>
<html><head><title>User Login</title></head>
<body>
<h2>Login</h2>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<div><?php echo $msg; ?></div>
<p>Don't have an account? <a href='user_register.php'>Register here</a></p>
</body></html>
