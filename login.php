<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }
        .login-container input[type="text"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>صفحه ورود</h2>
        <?php
        // نمایش پیام خطا در صورت وجود
        if (isset($_GET['error'])) {
            echo '<p class="error-message">نام کاربری یا رمز عبور اشتباه است</p>';
        }
        ?>
        <form method="POST" action="login.php">
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">رمز ورود:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="ورود">
        </form>
    </div>
</body>
</html>
<?php
session_start();

function validate_user($username, $password) {
    // باز کردن فایل به شکل ایمن
    $file = fopen("users.txt", "r");
    
    if ($file) {
        // خواندن هر خط از فایل
        while (($line = fgets($file)) !== false) {
            // جدا کردن نام کاربری و رمز عبور بر اساس ":"
            list($stored_username, $stored_password) = explode(":", trim($line));
            
            // مقایسه نام کاربری و رمز عبور
            if ($username === $stored_username && $password === $stored_password) {
                fclose($file); // بستن فایل بعد از پیدا کردن کاربر
                return true;
            }
        }
        
        fclose($file); // بستن فایل بعد از اتمام بررسی همه کاربران
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // گرفتن ورودی‌ها از فرم
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // اعتبارسنجی کاربر
    if (validate_user($username, $password)) {
        $_SESSION['username'] = $username; // ذخیره نام کاربری در سشن
        header("Location: welcome.php"); // هدایت به صفحه خوش‌آمدگویی
        exit();
    } else {
        // در صورت اشتباه بودن اطلاعات، هدایت به صفحه ورود با پیام خطا
        header("Location: login.php?error=1");
        exit();
    }
}
?>
