<!DOCTYPE html>
<html>
<head>
    <title>Phép Tính Trên Hai Số</title>
</head>
<body>
    <div style="text-align: center; border: 1px solid black; width: 450px; margin: 20px auto; padding: 20px;">
        <h2 style="color: #000080;">PHÉP TÍNH TRÊN HAI SỐ</h2>
        <form action="Bai3_ketqua.php" method="post">
            <p style="color: #000080; font-weight: bold;">
                Chọn phép tính :
                <input type="radio" name="phep_tinh" value="cong" checked> Cộng
                <input type="radio" name="phep_tinh" value="tru"> Trừ
                <input type="radio" name="phep_tinh" value="nhan"> Nhân
                <input type="radio" name="phep_tinh" value="chia"> Chia
            </p>
            <p style="color: #000080; font-weight: bold;">
                Số thứ nhất : <input type="text" name="so_thu_nhat">
            </p>
            <p style="color: #000080; font-weight: bold;">
                Số thứ nhì : <input type="text" name="so_thu_nhi">
            </p>
            <input type="submit" value="Tính">
        </form>
    </div>
    <div style="text-align:center; margin-top:30px;">
    <a href="index.php" style="font-size:18px; color:#007BFF; text-decoration:none;">Quay lại trang chủ</a>
</div>
</body>
</html>