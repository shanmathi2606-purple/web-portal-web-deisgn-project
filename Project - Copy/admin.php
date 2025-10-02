<?php
// Minimal admin viewer (no auth for demo). Shows orders and allows status update.
$host='localhost'; $user='root'; $pass=''; $db='blossom_db';
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB Conn error');

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['order_id']) && isset($_POST['status'])){
  $stmt = $conn->prepare('UPDATE orders SET status=? WHERE id=?');
  $stmt->bind_param('si',$_POST['status'],$_POST['order_id']);
  $stmt->execute();
  $stmt->close();
}

$res = $conn->query('SELECT id,cust_name,cust_email,status,menu_items,created_at FROM orders ORDER BY created_at DESC LIMIT 50');
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Admin — Blossom Buffet</title><link rel="stylesheet" href="css/style.css"></head><body>
<header class="site-header"><div class="brand"><img src="assets/logo.png" class="logo"><h1>Admin</h1></div></header>
<main class="container">
<h2>Recent Orders</h2>
<table class="menu-table"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Items</th><th>Status</th><th>When</th><th>Action</th></tr></thead><tbody>
<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']?></td>
<td><?php echo htmlspecialchars($row['cust_name'])?></td>
<td><?php echo htmlspecialchars($row['cust_email'])?></td>
<td><?php echo htmlspecialchars($row['menu_items'])?></td>
<td><?php echo htmlspecialchars($row['status'])?></td>
<td><?php echo $row['created_at']?></td>
<td>
  <form method="post" style="display:inline">
    <input type="hidden" name="order_id" value="<?php echo $row['id']?>">
    <select name="status"><option>Received</option><option>Preparing</option><option>Out for Delivery</option><option>Completed</option></select>
    <button type="submit" class="btn">Update</button>
  </form>
</td>
</tr>
<?php } ?>
</tbody></table>
</main></body></html>
