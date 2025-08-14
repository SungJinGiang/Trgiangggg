<?php
$books = [];
for ($i = 1; $i <= 100; $i++) {
    $books[] = [
        'ten' => "Tensach$i",
        'noidung' => "Noidung$i"
    ];
}

$perPage = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $perPage;

$currentBooks = array_slice($books, $start, $perPage);

$totalPages = ceil(count($books) / $perPage);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sách</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table { 
            border-collapse: collapse; 
            width: 60%; 
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: center; 
        }
        th {
            background-color: #f4f4f4;
        }
        .pagination {
            text-align: center;
            margin-top: 15px;
        }
        .pagination a {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 3px;
            border: 1px solid #ccc;
            background-color: #fff;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .pagination a:hover {
            background-color: #007BFF;
            color: #fff;
        }
        .pagination a.active {
            background-color: #007BFF;
            color: #fff;
            border-color: #007BFF;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Danh sách sách</h2>
<table>
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Nội dung sách</th>
    </tr>
    <?php foreach ($currentBooks as $index => $book): ?>
        <tr>
            <td><?= $start + $index + 1 ?></td>
            <td><?= $book['ten'] ?></td>
            <td><?= $book['noidung'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">«</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>">»</a>
    <?php endif; ?>
</div>
<div style="text-align:center; margin-top:30px;">
    <a href="index.php" style="font-size:18px; color:#007BFF; text-decoration:none;">Quay lại trang chủ</a>
</div>

</body>
</html>
