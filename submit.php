<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .result-box {
            width: 450px;
            background: #fff;
            padding: 25px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        h3 {
            color: #444;
            margin-bottom: 20px;
        }
        p {
            text-align: left;
            margin: 10px 0;
            font-size: 16px;
        }
        strong {
            color: #4a90e2;
        }
        .btn {
            display: inline-block;
            margin: 10px 5px;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-back { background: #28a745; }
        .btn-back:hover { background: #1e7e34; }
        .btn-reset { background: #ff8c42; }
        .btn-reset:hover { background: #e6782f; }
    </style>
</head>
<body>

<div class="result-box">
    <h2>Thông tin đã nhận</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h3>Dữ liệu được gửi bằng phương thức POST</h3>";
        $book_title = htmlspecialchars($_POST['book_title']);
        $author = htmlspecialchars($_POST['author']);
        $publisher = htmlspecialchars($_POST['publisher']);
        $pub_year = htmlspecialchars($_POST['pub_year']);
    }
    elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo "<h3>Dữ liệu được gửi bằng phương thức GET</h3>";
        $book_title = htmlspecialchars($_GET['book_title']);
        $author = htmlspecialchars($_GET['author']);
        $publisher = htmlspecialchars($_GET['publisher']);
        $pub_year = htmlspecialchars($_GET['pub_year']);
    }
    else {
        echo "<p>Không có dữ liệu nào được gửi.</p>";
        exit;
    }

    echo "<p><strong>Tên sách:</strong> $book_title</p>";
    echo "<p><strong>Tác giả:</strong> $author</p>";
    echo "<p><strong>Nhà xuất bản:</strong> $publisher</p>";
    echo "<p><strong>Năm xuất bản:</strong> $pub_year</p>";
    ?>

    <!-- Nút điều hướng -->
    <a href="btap.html" class="btn btn-back">Quay lại nhập</a>
</div>

</body>
</html>
