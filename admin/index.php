<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shope Online | إضافة منتجات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@300;500;700&family=Poppins:wght@200;400;600&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #fad0c4, #ff9a9e);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .main {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .main h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #444;
        }

        .main img {
            width: 200px;
            margin-bottom: 20px;
        }

        .main input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .main label {
            display: inline-block;
            background: #6c5ce7;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px 0;
            transition: background 0.3s;
        }

        .main label:hover {
            background: #5a4dcf;
        }

        .main button {
            background: #00b894;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .main button:hover {
            background: #019875;
        }

        .main a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #0984e3;
            font-weight: 500;
        }

        footer {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 13px;
            color: #fff;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="main">
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <h2>🛒 موقع تسويقي أونلاين</h2>
            <img src="logo.png" alt="logo">
            <input type="text" name='name' placeholder="اسم المنتج" required>
            <br>
            <input type="text" name='price' placeholder="سعر المنتج" required>
            <br>
            <input type="file" id="file" name='image' style='display:none;' required>
            <label for="file">📸 اختر صورة للمنتج</label>
            <br>
            <button name='upload'>✅ رفع المنتج</button>
            <br><br>
            <a href="products.php">عرض كل المنتجات</a>
        </form>
    </div>

    <footer>© كل الحقوق محفوظة لدى متجر العش</footer>

</body>
</html>
