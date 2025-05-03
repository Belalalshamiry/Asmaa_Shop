<!DOCTYPE html>
<html lang="ar">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | تعديل منتج</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .main {
            background-color: #fff;
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-family: 'Amiri', serif;
            font-size: 28px;
            margin-bottom: 20px;
            color:rgb(75, 24, 163);
        }

        input[type="text"], input[type="file"], button {
            width: 100%;
            padding: 12px 20px;
            margin: 12px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="text"], input[type="file"] {
            background-color: #f9f9f9;
        }

        button {
            background-color:rgb(51, 21, 140);
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:rgb(37, 101, 190);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }

        a {
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Fixed footer */
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            background-color: #f5f5f5;
            padding: 10px 0;
            font-size: 14px;
            color: #333;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php
    include('config.php');
    $ID=$_GET['id'];
    $up = mysqli_query($con, "SELECT * FROM products WHERE id =$ID");
    $data = mysqli_fetch_array($up);
    ?>
    <div class="main">
        <form action="up.php" method="post" enctype="multipart/form-data">
            <h2>تعديل المنتج</h2>
            <input type="text" name='id' value='<?php echo $data['id']?>' style='display:none;'>
            <input type="text" name='name' value='<?php echo $data['name']?>' placeholder="اسم المنتج">
            <input type="text" name='price' value='<?php echo $data['price']?>' placeholder="سعر المنتج">
            <input type="file" id="file" name='image'>
            <label for="file">تحديث صورة المنتج</label>
            <button name='update' type='submit'>تعديل المنتج</button>
        </form>
        <a href="products.php">عرض كل المنتجات</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>كل الحقوق محفوظة لدى <a href="#">متجر العش</a></p>
    </div>
</body>
</html>
