<?php
// تضمين إعدادات قاعدة البيانات
include 'config.php';

// بدء الجلسة
session_start();

// التحقق من إرسال النموذج
if (isset($_POST['submit'])) {
    // تأمين الإدخال من المستخدم
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, md5($_POST['password']));

    // استعلام للتحقق من بيانات المستخدم
    $select = mysqli_query(
        $conn,
        "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'"
    ) or die('فشل الاستعلام');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');
    } else {
        $message[] = '❌ البريد الإلكتروني أو كلمة المرور غير صحيحة!';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
            font-family: 'Cairo', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            animation: fadeIn 1.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-container {
            background: #fff;
            padding: 2.5rem;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            position: relative;
        }
        h3 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: #333;
        }
        input {
            text-align: center;
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 0.9rem;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 1.2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        input:focus {
            border-color: #4e91fc;
            box-shadow: 0 0 8px rgba(78,145,252,0.4);
            outline: none;
            background: #fff;
        }
        .btn {
            background: #4e91fc;
            color: #fff;
            border: none;
            padding: 0.9rem;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s;
        }
        .btn:hover {
            background: #3c7ee5;
            transform: translateY(-2px);
        }
        a {
            color: #4e91fc;
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        .message {
            background: #ff5252;
            color: #fff;
            padding: 0.8rem 1rem;
            margin: 1rem auto;
            width: 90%;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: relative;
            animation: fadeIn 1s ease;
        }
        .message span {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-weight: bold;
        }
        p {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<?php
// عرض الرسائل (إذا وجدت)
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message">' . $msg . '<span onclick="this.parentElement.remove();">&times;</span></div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>تسجيل الدخول</h3>
        <input type="email" name="email" required placeholder="البريد الإلكتروني" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="أدخل بريد إلكتروني صحيح">
        <input type="password" name="password" required placeholder="كلمة المرور (6 أحرف فأكثر)" minlength="6">
        <input type="submit" name="submit" class="btn" value="تسجيل الدخول">
        <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></p>
    </form>
</div>

</body>
</html>
