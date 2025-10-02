-- SQL schema + fake data for Blossom Buffet (Theme 1)
CREATE DATABASE IF NOT EXISTS blossom_db;
USE blossom_db;

DROP TABLE IF EXISTS menu_items;
CREATE TABLE menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120),
  category VARCHAR(40),
  price DECIMAL(6,2),
  img VARCHAR(255)
);

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120),
  email VARCHAR(120),
  phone VARCHAR(30),
  created_at DATETIME DEFAULT NOW()
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cust_name VARCHAR(120),
  cust_email VARCHAR(120),
  cust_phone VARCHAR(30),
  menu_items VARCHAR(255),
  event_date DATE,
  notes TEXT,
  status VARCHAR(40),
  created_at DATETIME DEFAULT NOW()
);

INSERT INTO menu_items (name,category,price,img) VALUES
('Signature Chicken Rice Platter','Main',4.50,'assets/item1.jpg'),
('Vegetarian Nasi Lemak Box','Main',4.20,'assets/item2.jpg'),
('Roasted Beef Slices','Main',6.80,'assets/item3.jpg'),
('Garden Salad (Vegan)','Sides',2.50,'assets/item4.jpg'),
('Mini Spring Rolls (10pcs)','Sides',3.00,'assets/item5.jpg'),
('Chocolate Cake Slice','Dessert',2.80,'assets/item6.jpg');

INSERT INTO customers (name,email,phone) VALUES
('Aisha Tan','aisha.tan@example.com','91234567'),
('Brandon Lim','brandon.lim@example.com','98761234'),
('Chen Wei','chen.wei@example.com','91239876');

INSERT INTO orders (cust_name,cust_email,cust_phone,menu_items,event_date,notes,status) VALUES
('Aisha Tan','aisha.tan@example.com','91234567','1,4,6','2025-11-05','Vegetarian option for 3 pax','Received'),
('Brandon Lim','brandon.lim@example.com','98761234','2,5','2025-10-20','Deliver to LT21 after 11am','Preparing'),
('Chen Wei','chen.wei@example.com','91239876','3,6','2025-12-01','Need extra cutlery','Out for Delivery');
