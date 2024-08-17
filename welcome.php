<?php
// welcome.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>خوش امدید</title>
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
        .welcome-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .welcome-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>خوش امدید, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>با موفقیت وارد شدید.</p>
    </div>
</body>
</html>
