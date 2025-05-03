<!DOCTYPE html>
<html lang="ar">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | المنتجات </title>
    <style>
        /* الخلفية المتحركة */
        @keyframes backgroundMove {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body {
            background: linear-gradient(45deg, #ff6a00, #ffcc00, #ff6a00, #ffcc00);
            background-size: 400% 400%;
            animation: backgroundMove 15s ease infinite;
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
        }

        h3 {
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
            margin-top: 20px;
            color: #007bff;
            font-size: 2rem;
        }

        .card {
            margin: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .card-text {
            font-family: 'Tajawal', sans-serif;
            font-size: 18px;
            color: #333;
        }

        .btn {
            font-family: 'Poppins', sans-serif;
            margin-top: 10px;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 40px;
        }

        .main-header {
            text-align: center;
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px;
            font-family: 'Tajawal', sans-serif;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .promo-text {
            font-size: 24px;
            color: #ff6a00;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="main-header">
        مرحبًا بك في متجر العش – حيث تلتقي الجودة بالأناقة!
    </div>
    
    <div class="promo-text">
        اكتشف العروض المذهلة الآن! 🛍️✨
    </div>

    <div class="container">
        <?php
        include('config.php');
        $result = mysqli_query($con, "SELECT * FROM products");
        while ($row = mysqli_fetch_array($result)) {
            echo "
                <div class='card' style='width: 18rem;'>
                    <img src='$row[image]' class='card-img-top'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>$row[price] ريال</p>
                        <a href='delete.php?id=$row[id]' class='btn btn-danger'>حذف منتج</a>
                        <a href='update.php?id=$row[id]' class='btn btn-primary'>تعديل منتج</a>
                    </div>
                </div>
            ";
        }
        ?>
    </div>

    <div class="footer">
        <p>كل الحقوق محفوظة لدى <a href="#">متجر العش</a></p>
    </div>

</body>
</html>
