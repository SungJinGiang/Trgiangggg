<?php
// index.php - Menu kết nối 4 bài tập
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Menu Bài Tập PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .menu {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        a {
            display: block;
            padding: 12px;
            margin: 10px 0;
            background: #5563DE;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        a:hover {
            background: #3949AB;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="menu">
        <h2>📚 Menu Bài Tập</h2>
        <a href="Bai1.php">Bài 1</a>
        <a href="Bai2.php">Bài 2</a>
        <a href="Bai3_pheptinh.php">Bài 3</a>
        <a href="Bai4_index.php">Bài 4</a>
    </div>
</body>
</html>
