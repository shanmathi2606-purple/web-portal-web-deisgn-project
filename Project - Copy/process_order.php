<?php
// Simple order processing script (for IE4727 demo).
$host='localhost';
$user='root';
$pass='';
$db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');

$cust_name = $_POST['cust_name'] ?? '';
$cust_email = $_POST['cust_email'] ?? '';
$cust_phone = $_POST['cust_phone'] ?? '';
$menu_items = $_POST['menu_items'] ?? '';
$event_date = $_POST['event_date'] ?? '';
$notes = $_POST['notes'] ?? '';

$stmt = $conn->prepare('INSERT INTO orders (cust_name,cust_email,cust_phone,menu_items,event_date,notes,status,created_at) VALUES (?,?,?,?,?,?,"Received",NOW())');
$stmt->bind_param('ssssss',$cust_name,$cust_email,$cust_phone,$menu_items,$event_date,$notes);
if($stmt->execute()){
  $order_id = $conn->insert_id;
  echo "<h2>Order Received</h2><p>Your Order ID: <strong>$order_id</strong></p><p><a href=\"status.html\">Check status</a></p>";
} else {
  echo "<h2>Order Failed</h2><p>Try again later.</p>";
}
$stmt->close();
$conn->close();
?>