<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    // تحقق هل البريد موجود
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('فشل الاستعلام');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'المستخدم موجود مسبقًا!';
    } elseif ($pass !== $cpass) {
        $message[] = 'كلمة المرور غير متطابقة!';
    } else {
        mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('فشل الاستعلام');
        $message[] = 'تم التسجيل بنجاح!';
        header('refresh:2;login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap">
    <style>
        * { margin:0; padding:0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            font-family: 'Cairo', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 2.5rem;
            border-radius: 12px;
            width: 340px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: slideFade 1s ease forwards;
            opacity: 0;
            transform: translateY(-20px);
        }
        @keyframes slideFade {
            to { opacity:1; transform: translateY(0); }
        }
        h3 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: #444;
        }
        .box {
            position: relative;
            margin-bottom: 1rem;
        }
        .box input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
            font-size: 1rem;
            transition: border 0.3s, box-shadow 0.3s;
        }
        .box input:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 6px rgba(92,107,192,0.3);
            outline: none;
        }
        .box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .btn {
            width: 100%;
            background: #5c6bc0;
            color: #fff;
            border: none;
            padding: 0.9rem;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .btn:hover {
            background: #3f51b5;
            transform: translateY(-2px);
        }
        p {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
        }
        p a {
            color: #3f51b5;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
        .message {
            background: #ff6b6b;
            color: #fff;
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            animation: fadeInOut 4s forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-10px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
    </style>
    <script>
        function validateForm() {
            const pass = document.forms["regForm"]["password"].value;
            const cpass = document.forms["regForm"]["cpassword"].value;
            if (pass !== cpass) {
                alert("كلمة المرور غير متطابقة!");
                return false;
            }
        }
    </script>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message">' . $msg . '</div>';
    }
}
?>

<div class="form-container">
    <form name="regForm" action="" method="post" onsubmit="return validateForm()">
        <h3>إنشاء حساب جديد</h3>
        <div class="box">
            <i>👤</i>
            <input type="text" name="name" required placeholder="اسم المستخدم">
        </div>
        <div class="box">
            <i>📧</i>
            <input type="email" name="email" required placeholder="البريد الإلكتروني">
        </div>
        <div class="box">
            <i>🔑</i>
            <input type="password" name="password" required placeholder="كلمة المرور">
        </div>
        <div class="box">
            <i>✅</i>
            <input type="password" name="cpassword" required placeholder="تأكيد كلمة المرور">
        </div>
        <input type="submit" name="submit" class="btn" value="تسجيل حساب">
        <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل دخول</a></p>
    </form>
</div>

</body>
</html>
