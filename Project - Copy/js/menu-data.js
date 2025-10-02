// Fake menu dataset used only for front-end demo
const MENU = [
  {id:1,name:'Signature Chicken Rice Platter',category:'Main',price:4.50,img:'assets/item1.jpg'},
  {id:2,name:'Vegetarian Nasi Lemak Box',category:'Main',price:4.20,img:'assets/item2.jpg'},
  {id:3,name:'Roasted Beef Slices',category:'Main',price:6.80,img:'assets/item3.jpg'},
  {id:4,name:'Garden Salad (Vegan)',category:'Sides',price:2.50,img:'assets/item4.jpg'},
  {id:5,name:'Mini Spring Rolls (10pcs)',category:'Sides',price:3.00,img:'assets/item5.jpg'},
  {id:6,name:'Chocolate Cake Slice',category:'Dessert',price:2.80,img:'assets/item6.jpg'},
];

window.addEventListener('DOMContentLoaded',()=>{
  const tbody=document.querySelector('#menu-table tbody');
  MENU.forEach(it=>{
    const tr=document.createElement('tr');
    tr.innerHTML=`
      <td><img src="\${it.img}" alt="\${it.name}"></td>
      <td>\${it.name}<br><small>ID: \${it.id}</small></td>
      <td>\${it.category}</td>
      <td>\${it.price.toFixed(2)}</td>
      <td><button class="btn" onclick="copyId(\${it.id})">Copy ID</button></td>
    `;
    tbody.appendChild(tr);
  });
});

function copyId(id){
  navigator.clipboard?.writeText(String(id));
  alert('Copied ID '+id+' — paste into the order form');
}
