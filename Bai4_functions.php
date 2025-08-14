<?php
// Bai4_functions.php

/**
 * Tìm giá trị lớn nhất trong một mảng.
 * @param array $arr Mảng đầu vào.
 * @return mixed Giá trị lớn nhất hoặc false nếu mảng rỗng.
 */
function find_max_value(array $arr) {
    if (empty($arr)) {
        return false;
    }
    return max($arr);
}

/**
 * Tìm giá trị nhỏ nhất trong một mảng.
 * @param array $arr Mảng đầu vào.
 * @return mixed Giá trị nhỏ nhất hoặc false nếu mảng rỗng.
 */
function find_min_value(array $arr) {
    if (empty($arr)) {
        return false;
    }
    return min($arr);
}

/**
 * Tính tổng các phần tử trong một mảng.
 * @param array $arr Mảng đầu vào.
 * @return int Tổng các phần tử.
 */
function calculate_sum(array $arr) {
    return array_sum($arr);
}

/**
 * Kiểm tra xem một giá trị có tồn tại trong mảng hay không.
 * @param mixed $value Giá trị cần kiểm tra.
 * @param array $arr Mảng đầu vào.
 * @return bool True nếu giá trị tồn tại, ngược lại là false.
 */
function check_if_exists($value, array $arr) {
    return in_array($value, $arr);
}

/**
 * Sắp xếp một mảng theo thứ tự tăng dần.
 * @param array $arr Mảng đầu vào.
 * @return array Mảng đã được sắp xếp.
 */
function sort_array(array $arr) {
    sort($arr);
    return $arr;
}

?>