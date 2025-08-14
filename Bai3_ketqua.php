<!DOCTYPE html>
<html>
<head>
    <title>Kết Quả Phép Tính</title>
</head>
<body>
    <div style="text-align: center; border: 1px solid black; width: 450px; margin: 20px auto; padding: 20px;">
        <h2 style="color: #000080;">PHÉP TÍNH TRÊN HAI SỐ</h2>
        <?php
        require_once 'Bai3_ham_xuly.php';

        $so_1 = isset($_POST['so_thu_nhat']) ? $_POST['so_thu_nhat'] : '';
        $so_2 = isset($_POST['so_thu_nhi']) ? $_POST['so_thu_nhi'] : '';
        $phep_tinh = isset($_POST['phep_tinh']) ? $_POST['phep_tinh'] : '';
        $ket_qua = '';
        $ten_phep_tinh = '';

        if (!empty($phep_tinh) && is_numeric($so_1) && is_numeric($so_2)) {
            switch ($phep_tinh) {
                case 'cong':
                    $ket_qua = tinhTong($so_1, $so_2);
                    $ten_phep_tinh = 'Cộng';
                    break;
                case 'tru':
                    $ket_qua = tinhHieu($so_1, $so_2);
                    $ten_phep_tinh = 'Trừ';
                    break;
                case 'nhan':
                    $ket_qua = tinhTich($so_1, $so_2);
                    $ten_phep_tinh = 'Nhân';
                    break;
                case 'chia':
                    $ket_qua = tinhThuong($so_1, $so_2);
                    $ten_phep_tinh = 'Chia';
                    break;
            }
        }
        ?>
        <p style="color: #000080; font-weight: bold;">
            Chọn phép tính : <span style="color: #000;"><?php echo htmlspecialchars($ten_phep_tinh); ?></span>
        </p>
        <p style="color: #000080; font-weight: bold;">
            Số 1 : <input type="text" value="<?php echo htmlspecialchars($so_1); ?>" readonly>
        </p>
        <p style="color: #000080; font-weight: bold;">
            Số 2 : <input type="text" value="<?php echo htmlspecialchars($so_2); ?>" readonly>
        </p>
        <p style="color: #000080; font-weight: bold;">
            Kết quả : <input type="text" value="<?php echo htmlspecialchars($ket_qua); ?>" readonly>
        </p>
        <a href="Bai3_pheptinh.php" style="color: #800080;">Quay lại trang trước</a>
    </div>
    <div style="text-align:center; margin-top:30px;">
    <a href="index.php" style="font-size:18px; color:#007BFF; text-decoration:none;">Quay lại trang chủ</a>
</div>
</body>
</html>