<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ho = $_POST['ho'] ?? '';
    $ten = $_POST['ten'] ?? '';
    $email = $_POST['email'] ?? '';
    $mahoadon = $_POST['mahoadon'] ?? '';
    $thanhtoan = $_POST['thanhtoan'] ?? [];
    $ghichu = $_POST['ghichu'] ?? '';
    $fileUrl = "";

    // ✅ Lưu vào SESSION
    $_SESSION['ho'] = $ho;
    $_SESSION['ten'] = $ten;
    $_SESSION['email'] = $email;
    $_SESSION['mahoadon'] = $mahoadon;
    $_SESSION['thanhtoan'] = $thanhtoan;
    $_SESSION['ghichu'] = $ghichu;

    // ✅ Lưu vào COOKIE (sống 1h)
    setcookie('ho', $ho, time() + 3600, "/");
    setcookie('ten', $ten, time() + 3600, "/");
    setcookie('email', $email, time() + 3600, "/");
    setcookie('mahoadon', $mahoadon, time() + 3600, "/");
    setcookie('ghichu', $ghichu, time() + 3600, "/");
    // Thanh toán là mảng, lưu dạng JSON
    setcookie('thanhtoan', json_encode($thanhtoan), time() + 3600, "/");

    // Xử lý file upload
    if (isset($_FILES['bienlai']) && $_FILES['bienlai']['error'] === 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['bienlai']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['bienlai']['tmp_name'], $targetPath)) {
            $fileUrl = $targetPath; // chỉ cần lưu đường dẫn
            $_SESSION['fileUrl'] = $fileUrl;
            setcookie('fileUrl', $fileUrl, time() + 3600, "/");
        }
    }
}

// ✅ Lấy dữ liệu từ SESSION trước, nếu không có thì dùng COOKIE
$ho = $_SESSION['ho'] ?? ($_COOKIE['ho'] ?? '');
$ten = $_SESSION['ten'] ?? ($_COOKIE['ten'] ?? '');
$email = $_SESSION['email'] ?? ($_COOKIE['email'] ?? '');
$mahoadon = $_SESSION['mahoadon'] ?? ($_COOKIE['mahoadon'] ?? '');
$thanhtoan = $_SESSION['thanhtoan'] ?? 
             (isset($_COOKIE['thanhtoan']) ? json_decode($_COOKIE['thanhtoan'], true) : []);
$ghichu = $_SESSION['ghichu'] ?? ($_COOKIE['ghichu'] ?? '');
$fileUrl = $_SESSION['fileUrl'] ?? ($_COOKIE['fileUrl'] ?? '');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      padding: 30px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: white;
      border-radius: 12px;
      padding: 20px 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2d3436;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }
    td:first-child {
      font-weight: bold;
      color: #0984e3;
      width: 30%;
    }
    .note {
      white-space: pre-line;
    }
    .image-preview {
      text-align: center;
      margin-top: 20px;
    }
    .image-preview img {
      max-width: 100%;
      border-radius: 8px;
      border: 2px solid #ddd;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .back-btn {
      display: inline-block;
      padding: 10px 20px;
      background: #0984e3;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s;
    }
    .back-btn:hover {
      background: #74b9ff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📋 Kết quả thông tin đã gửi</h2>
    <table>
      <tr><td>Họ tên</td><td><?= htmlspecialchars($ho . " " . $ten) ?></td></tr>
      <tr><td>Email</td><td><?= htmlspecialchars($email) ?></td></tr>
      <tr><td>Mã hóa đơn</td><td><?= htmlspecialchars($mahoadon) ?></td></tr>
      <tr><td>Thanh toán cho</td>
          <td><?= !empty($thanhtoan) ? implode(", ", array_map("htmlspecialchars", $thanhtoan)) : "Không chọn" ?></td></tr>
      <tr><td>Ghi chú</td><td class="note"><?= htmlspecialchars($ghichu) ?></td></tr>
    </table>

    <?php if ($fileUrl): ?>
      <div class="image-preview">
        <h3>Ảnh biên lai:</h3>
        <img src="<?= $fileUrl ?>" alt="Biên lai">
      </div>
    <?php else: ?>
      <p style="color:red; text-align:center;">❌ Chưa có ảnh biên lai hoặc upload thất bại!</p>
    <?php endif; ?>

    <div style="text-align:center; margin-top: 20px;">
      <a href="index.html" class="back-btn">⬅ Trang chủ</a>
      <a href="btapvn.php" class="back-btn">⬅ Trang trước</a>
    </div>
  </div>
</body>
</html>
