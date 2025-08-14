<?php
// Bai4_index.php

include 'Bai4_functions.php';

$initial_array = [];
$element_to_check = null;
$display_results = false;
$exists_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_string = $_POST['array_input'];
    $check_number_string = $_POST['check_number'];

    $input_array_raw = explode(',', $input_string);
    $initial_array = array_map('intval', array_filter($input_array_raw));
    
    $element_to_check = intval($check_number_string);

    if (!empty($initial_array)) {
        $display_results = true;
        $max_value = find_max_value($initial_array);
        $min_value = find_min_value($initial_array);
        $array_sum = calculate_sum($initial_array);
        $sorted_array = sort_array($initial_array);
        
        $exists = check_if_exists($element_to_check, $initial_array);
        $exists_message = $exists ? "$element_to_check có trong mảng" : "$element_to_check không có trong mảng";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Functions</title>
    <link rel="stylesheet" href="Bai4_style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Array Functions</h1>
        <div class="form-container">
            <form action="Bai4_index.php" method="post">
                <label for="array_input">Nhập mảng (cách nhau bởi dấu phẩy):</label>
                <div class="input-group">
                    <input type="text" id="array_input" name="array_input" placeholder="VD: 5, 2, 9, 1, 7, 3" required>
                    <input type="text" id="check_number" name="check_number" placeholder="Số cần kiểm tra" required>
                    <button type="submit">Xử lý</button>
                </div>
            </form>
        </div>
        
        <?php if ($display_results): ?>
        <div class="result-box">
            <p><strong>Mảng ban đầu:</strong> <?php echo implode(', ', $initial_array); ?></p>
            <p><strong>Giá trị lớn nhất trong mảng:</strong> <?php echo $max_value; ?></p>
            <p><strong>Giá trị nhỏ nhất trong mảng:</strong> <?php echo $min_value; ?></p>
            <p><strong>Tổng các phần tử trong mảng:</strong> <?php echo $array_sum; ?></p>
            <p><strong>Mảng sau khi sắp xếp:</strong> <?php echo implode(', ', $sorted_array); ?></p>
            <p><strong><?php echo $exists_message; ?></strong></p>
        </div>
        <?php endif; ?>
<div style="text-align:center; margin-top:30px;">
    <a href="index.php" style="font-size:18px; color:#007BFF; text-decoration:none;">Quay lại trang chủ</a>
</div>
</body>
</html>