// Simple client-side helpers
function validateOrder(){
  const name=document.getElementById('cust_name').value.trim();
  const email=document.getElementById('cust_email').value.trim();
  const items=document.getElementById('menu_items').value.trim();
  if(!name||!email||!items){ alert('Please fill required fields'); return false;}
  // minimal validation passed
  return true;
}

function validateStatus(){
  const id = document.getElementById('order_id').value.trim();
  if(!id){ alert('Enter Order ID'); return false; }
  return true;
}
