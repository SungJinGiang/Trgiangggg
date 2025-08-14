<?php
// Tính tổng hai số
function tinhTong($a, $b) {
    return $a + $b;
}

// Tính hiệu hai số
function tinhHieu($a, $b) {
    return $a - $b;
}

// Tính tích hai số
function tinhTich($a, $b) {
    return $a * $b;
}

// Tính thương hai số
function tinhThuong($a, $b) {
    if ($b == 0) {
        return "Không thể chia cho 0";
    }
    return $a / $b;
}

// Kiểm tra một số có phải là số nguyên tố hay không
function laSoNguyenTo($n) {
    if ($n <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

// Kiểm tra một số có phải là số chẵn hay không
function laSoChan($n) {
    return ($n % 2 == 0);
}
?>