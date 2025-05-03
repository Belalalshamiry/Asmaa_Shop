<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'المنتج أضيف بالفعل إلى عربة التسوق!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'المنتج يضاف الى عربة التسوق!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'تم تحديث كمية سلة التسوق بنجاح!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>عربة التسوق</title>
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Cairo', sans-serif;
      }
      body {
         min-height: 100vh;
         background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ade80, #facc15);
         background-size: 400% 400%;
         animation: gradientBG 12s ease infinite;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 20px;
      }
      @keyframes gradientBG {
         0% { background-position: 0% 50%; }
         50% { background-position: 100% 50%; }
         100% { background-position: 0% 50%; }
      }
      .container {
         background: rgba(255, 255, 255, 0.9);
         border-radius: 15px;
         padding: 30px;
         width: 95%;
         max-width: 1200px;
         box-shadow: 0 15px 35px rgba(0,0,0,0.2);
         position: relative;
      }
      h1.heading {
         text-align: center;
         margin-bottom: 20px;
         font-weight: bold;
         color: #333;
         text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
      }
      .user-profile {
         text-align: center;
         margin-bottom: 20px;
      }
      .user-profile p span {
         font-weight: bold;
         color: #1e90ff;
      }
      .flex {
         margin-top: 10px;
      }
      .delete-btn, .option-btn, .btn, .paypal-btn {
         background: #ff6ec4;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         text-decoration: none;
         display: inline-block;
         margin: 5px 0;
         transition: 0.3s ease;
         position: relative;
         overflow: hidden;
      }
      .delete-btn::after, .option-btn::after, .btn::after, .paypal-btn::after {
         content: "";
         position: absolute;
         top: 0; left: -100%;
         width: 100%; height: 100%;
         background: rgba(255,255,255,0.3);
         transition: 0.5s;
      }
      .delete-btn:hover::after, .option-btn:hover::after, .btn:hover::after, .paypal-btn:hover::after {
         left: 100%;
      }
      .delete-btn:hover, .option-btn:hover, .btn:hover, .paypal-btn:hover {
         background: #7873f5;
         transform: scale(1.05);
      }
      .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
         gap: 20px;
      }
      .box {
         background: white;
         padding: 15px;
         border-radius: 10px;
         box-shadow: 0 10px 20px rgba(0,0,0,0.1);
         text-align: center;
         transition: transform 0.3s ease;
      }
      .box:hover {
         transform: translateY(-10px);
      }
      .box img {
         width: 100%;
         border-radius: 10px;
         margin-bottom: 10px;
         transition: transform 0.3s ease;
      }
      .box img:hover {
         transform: scale(1.1);
      }
      .box .name {
         font-weight: bold;
         margin: 10px 0;
      }
      .box .price {
         color: #4ade80;
         font-weight: bold;
         margin-bottom: 10px;
      }
      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
         background: white;
         border-radius: 10px;
         overflow: hidden;
         box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      }
      th, td {
         padding: 12px;
         text-align: center;
         border-bottom: 1px solid #eee;
      }
      th {
         background: #ff6ec4;
         color: white;
      }
      tr:hover {
         background: #f1f1f1;
      }
      .table-bottom {
         font-weight: bold;
         background: #fafafa;
      }
      .message {
         background: rgba(0,0,0,0.7);
         color: white;
         padding: 10px 20px;
         position: fixed;
         top: 20px;
         right: 20px;
         border-radius: 8px;
         cursor: pointer;
         z-index: 999;
         box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      }
      .paypal-button-container {
         margin-top: 20px;
         text-align: center;
      }
      .disabled {
         pointer-events: none;
         opacity: 0.5;
      }
   </style>

</head>
<body>
   
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">

<div class="user-profile">

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p>المستخدم الحالي : <span><?php echo $fetch_user['name']; ?></span> </p>
   <div class="flex">
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('هل أنت متأكد أنك تريد تسجيل الخروج؟');" class="delete-btn">تسجيل الخروج</a>
   </div>

</div>

<div class="products">

   <h1 class="heading">أحدث المنتجات</h1>

   <div class="box-container">

   <?php
   include('config.php');
   $result = mysqli_query($conn, "SELECT * FROM products");      
   while($row = mysqli_fetch_array($result)){
   ?>
      <form method="post" class="box" action="">
         <img src="admin/<?php echo $row['image']; ?>"  width="200">
         <div class="name"><?php echo $row['name']; ?></div>
         <div class="price"><?php echo $row['price']; ?></div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   ?>

   </div>

</div>

<div class="shopping-cart">

   <h1 class="heading"> عربة التسوق</h1>

   <table>
      <thead>
         <th>الصورة</th>
         <th>الاسم</th>
         <th>السعر</th>
         <th>العدد</th>
         <th>السعر الكلي</th>
         <th>العمل</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']; ?>$ </td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="تعديل" class="option-btn">
               </form>
            </td>
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('إزالة العنصر من سلة التسوق؟');">حذف</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">العربة فارغة</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">المبلغ الإجمالي :</td>
         <td><?php echo $grand_total; ?>$</td>
         <td><a href="index.php?delete_all" onclick="return confirm('حذف كل المنتجات من العربة?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">حذف الكل</a></td>
      </tr>
   </tbody>
   </table>

   <div class="paypal-button-container">
      <a href="https://www.paypal.com/paypalme/sb-1ygr038434964@personal.example.com/<?php echo $grand_total; ?>" target="_blank" class="paypal-btn <?php echo ($grand_total > 0)?'':'disabled'; ?>">الدفع عبر PayPal</a>
   </div>

</div>

</div>

</body>
</html>
