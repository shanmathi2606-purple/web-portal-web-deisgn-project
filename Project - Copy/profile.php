<?php
session_start();
if(!isset($_SESSION['user_id'])) { header('Location: user_login.php'); exit; }
$host='localhost'; $user='root'; $pass=''; $db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');

$user_id = $_SESSION['user_id'];
$msg = '';

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['menu_items'])){
    $menu_items = $conn->real_escape_string($_POST['menu_items']);
    $stmt = $conn->prepare("INSERT INTO orders (cust_name, cust_email, menu_items, status, created_at, user_id) VALUES (?, ?, ?, 'Received', NOW(), ?)");
    $stmt->bind_param('sssi', $_SESSION['user_name'], $_SESSION['user_email'], $menu_items, $user_id);
    if($stmt->execute()) $msg = "Order placed!";
    else $msg = "Could not place order.";
    $stmt->close();
}

// Fetch user info
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id=?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();
$_SESSION['user_email'] = $email;

// Fetch user's orders
$res = $conn->query("SELECT id, menu_items, status, created_at FROM orders WHERE user_id=$user_id ORDER BY created_at DESC");
?>
<!doctype html>
<html><head><title>Your Profile</title></head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>
<p>Email: <?php echo htmlspecialchars($email); ?></p>
<a href="logout.php">Logout</a>
<h3>Place a new order:</h3>
<form method="post">
    Menu Items: <input type="text" name="menu_items" required><br>
    <button type="submit">Order</button>
</form>
<div><?php echo $msg; ?></div>
<h3>Your Orders</h3>
<table border="1">
    <tr><th>ID</th><th>Items</th><th>Status</th><th>When</th></tr>
    <?php while($row = $res->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['menu_items']); ?></td>
        <td><?php echo htmlspecialchars($row['status']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php } ?>
</table>
</body></html>
