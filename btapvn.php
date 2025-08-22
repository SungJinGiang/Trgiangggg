<?php
session_start(); // ✅ thêm để chuẩn bị dùng session
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Biểu mẫu biên lai thanh toán</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; background: #f7f7f7; }
  h2 { text-align: center; }
  form { width: 820px; margin: 0 auto; background: #fff; padding: 22px; border-radius: 10px; }
  label { font-weight: bold; display: block; margin-top: 12px; }
  input[type=text], input[type=email], textarea {
    width: 100%; padding: 10px; margin-top: 6px;
    border: 1px solid #ccc; border-radius: 6px;
  }
  .hang { display: flex; gap: 20px; margin-top: 10px; }
  .hang > div { flex: 1; }
  .danh-sach { margin-top: 10px; }
  .danh-sach-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 24px; margin-top: 10px; }
  .danh-sach-grid label { font-weight: normal; }
  .drop-zone {
    margin-top: 10px; padding: 28px; border: 2px dashed #aaa;
    text-align: center; color: #666; cursor: pointer;
    border-radius: 10px; background: #fafafa;
  }
  .drop-zone.dragover { border-color: #333; background-color: #f0f0f0; }
  .goi-y { font-size: 13px; color: #666; margin-top: 6px; }
  .xem-truoc { margin-top: 12px; }
  .xem-truoc img { max-width: 260px; border: 1px solid #ddd; border-radius: 6px; padding: 4px; }
  .submit { text-align: center; margin-top: 20px; }
  .submit input[type=submit] {
    background: #000; color: #fff; padding: 12px 32px; border: 0; border-radius: 6px; cursor: pointer; font-size: 16px;
  }
  .loi { color: #b00020; font-size: 13px; margin-top: 4px; display:none; }
</style>
</head>
<body>
  <h2>Biểu mẫu biên lai thanh toán</h2>

  <form id="formBienLai" action="ketqua.php" method="post" enctype="multipart/form-data">
    <!-- 1) Họ và tên -->
    <div class="hang">
      <div>
        <label>Họ</label>
        <input type="text" name="ho" required>
      </div>
      <div>
        <label>Tên</label>
        <input type="text" name="ten" required>
      </div>
    </div>

    <!-- 2) Email + Mã hóa đơn -->
    <div class="hang">
      <div>
        <label>Email</label>
        <input type="email" name="email" placeholder="vidu@email.com" required>
      </div>
      <div>
        <label>Mã hóa đơn</label>
        <input type="text" name="mahoadon" required>
      </div>
    </div>

    <!-- 3) Danh mục thanh toán -->
    <label class="danh-sach">Thanh toán cho</label>
    <div class="danh-sach-grid">
      <label><input type="checkbox" name="thanhtoan[]" value="Hạng 15K"> Hạng 15K</label>
      <label><input type="checkbox" name="thanhtoan[]" value="Hạng 35K"> Hạng 35K</label>

      <label><input type="checkbox" name="thanhtoan[]" value="Hạng 55K"> Hạng 55K</label>
      <label><input type="checkbox" name="thanhtoan[]" value="Hạng 75K"> Hạng 75K</label>

      <label><input type="checkbox" name="thanhtoan[]" value="Hạng 116K"> Hạng 116K</label>
      <label><input type="checkbox" name="thanhtoan[]" value="Xe đưa đón 1 chiều"> Xe đưa đón 1 chiều</label>

      <label><input type="checkbox" name="thanhtoan[]" value="Xe đưa đón 2 chiều"> Xe đưa đón 2 chiều</label>
      <label><input type="checkbox" name="thanhtoan[]" value="Mũ lưỡi trai"> Mũ lưỡi trai</label>

      <label><input type="checkbox" name="thanhtoan[]" value="Áo thun Compressport"> Áo thun Compressport</label>
      <label><input type="checkbox" name="thanhtoan[]" value="Khăn Buf"> Khăn Buf</label>

      <label><input type="checkbox" name="thanhtoan[]" value="Khác"> Khác</label>
    </div>
    <div class="loi" id="loi-thanhtoan">Vui lòng chọn ít nhất 1 mục.</div>

    <!-- 4) Upload -->
    <label style="margin-top:18px;">Tải biên lai thanh toán</label>
    <div class="drop-zone" id="drop-zone">
      Kéo & thả file vào đây hoặc bấm để chọn
      <input type="file" name="bienlai" id="file-input" hidden accept="image/*" required>
    </div>
    <div class="goi-y">jpg, jpeg, png, gif (tối đa 1MB)</div>
    <div class="loi" id="loi-file">File không hợp lệ hoặc vượt quá 1MB.</div>
    <div class="xem-truoc" id="xem-truoc"></div>

    <!-- 5) Thông tin bổ sung -->
    <label style="margin-top:18px;">Thông tin bổ sung</label>
    <textarea name="ghichu" rows="4" placeholder="Nhập thêm thông tin..."></textarea>

    <!-- 6) Gửi -->
    <div class="submit">
      <input type="submit" value="Gửi">
    </div>
  </form>

<script>
const form = document.getElementById('formBienLai');
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const xemtruoc = document.getElementById('xem-truoc');
const loiFile = document.getElementById('loi-file');
const loiThanhToan = document.getElementById('loi-thanhtoan');

const MAX_SIZE = 1 * 1024 * 1024; // 1MB
const HOP_LE = ['image/jpeg','image/png','image/gif'];

// Bấm chuột mở hộp chọn file
dropZone.addEventListener('click', () => fileInput.click());

// Xem trước khi chọn file
fileInput.addEventListener('change', () => {
  if (fileInput.files.length) xuLyFile(fileInput.files[0]);
});

// Kéo thả file
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('dragover'); });
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
dropZone.addEventListener('drop', (e) => {
  e.preventDefault(); dropZone.classList.remove('dragover');
  if (e.dataTransfer.files.length) {
    fileInput.files = e.dataTransfer.files;
    xuLyFile(fileInput.files[0]);
  }
});

function xuLyFile(file) {
  loiFile.style.display = 'none';
  xemtruoc.innerHTML = '';
  if (!HOP_LE.includes(file.type) || file.size > MAX_SIZE) {
    loiFile.style.display = 'block';
    fileInput.value = '';
    return;
  }
  const img = document.createElement('img');
  img.src = URL.createObjectURL(file);
  xemtruoc.appendChild(img);
}

// Kiểm tra trước khi gửi
form.addEventListener('submit', (e) => {
  // ít nhất 1 mục thanh toán
  const checked = document.querySelectorAll('input[name="thanhtoan[]"]:checked').length;
  if (checked === 0) {
    loiThanhToan.style.display = 'block';
    e.preventDefault();
    return;
  } else {
    loiThanhToan.style.display = 'none';
  }

  // kiểm tra file
  if (!fileInput.files.length) {
    loiFile.style.display = 'block';
    e.preventDefault();
    return;
  }
  const f = fileInput.files[0];
  if (!HOP_LE.includes(f.type) || f.size > MAX_SIZE) {
    loiFile.style.display = 'block';
    e.preventDefault();
  }
});
</script>
</body>
</html>
