<?php
$host='localhost'; $user='root'; $pass=''; $db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');
$order_id = intval($_GET['order_id'] ?? 0);
if(!$order_id){ echo '<p>Invalid Order ID</p>'; exit; }
$stmt = $conn->prepare('SELECT id,cust_name,status,menu_items,event_date,created_at FROM orders WHERE id=?');
$stmt->bind_param('i',$order_id);
$stmt->execute();
$res = $stmt->get_result();
if($row = $res->fetch_assoc()){
  echo '<h3>Order #'.$row['id'].'</h3>';
  echo '<p><strong>Name:</strong> '.htmlspecialchars($row['cust_name']).'</p>';
  echo '<p><strong>Status:</strong> '.htmlspecialchars($row['status']).'</p>';
  echo '<p><strong>Items:</strong> '.htmlspecialchars($row['menu_items']).'</p>';
  echo '<p><strong>Event date:</strong> '.htmlspecialchars($row['event_date']).'</p>';
  echo '<p><strong>Placed:</strong> '.htmlspecialchars($row['created_at']).'</p>';
} else {
  echo '<p>Order not found</p>';
}
$stmt->close();
$conn->close();
?>