<?php
// Core.php
// Tệp tin này chứa các thông tin khởi chạy cơ bản như kết nối đến database, session,...

session_start();

// Gọi file config vào đầu tiên để lấy các thông tin khởi chạy
include 'config.php';

// Kết nối đến database
$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($db->error) {
    die('Can not connect to database');
}

/**
 * Hàm thực hiện truy vấn nhiều kết quả
 *
 * Truy vấn dữ liệu từ database mất nhiều công đoạn mới
 * có thể xử lý thành kết quả mong muốn. Chính vì thế tôi đã
 * tạo ra một hàm có nhiệm vụ thực hiện một câu lệnh truy vấn select.
 * Hàm này chỉ cần truyên vào một câu lệnh select thông thường
 * và trả về kết quả dưới dạng một mảng
 *
 * Tham khảo thêm
 * @url http://weblv1.phambinh.net/thuc-thi-cau-lenh-select-tu-php-toi-mysql.html
 * @url http://weblv1.phambinh.net/ham-trong-php.html
 * 
 * @param  string $sql Câu lệnh truy vấn
 * @return array      Kết quả của câu lệnh truy vấn
 */
function db_select ($sql) {
    global $db;
    $results = array();
    $query = $db->query($sql);
    while ($row = $query->fetch_assoc()) {
        $results[] = $row;
    }

    return $results;
}

/**
 * Hàm thực hiện truy vấn một kết quả
 *
 * Hàm này cũng thực hiện truy vấn select từ database tương tự hàm db_select
 * Tuy nhiêm hàm này chỉ trả về kết quả truy vấn đầu tiên.
 * Hàm này sẽ hữu ích khi bạn muốn select một thông tin nào đó
 * mà biết chắc chắn rằng kết quả trả về chỉ có 1. Ví dụ như trường hợp select một
 * user theo ID của user đó chẳng hạn.
 * 
 * @param  string $sql Câu lệnh truy vấn
 * @return array      Kết quả của câu lệnh truy vấn
 */
function db_first_row ($sql) {
    global $db;
    $results = array();
    $query = $db->query($sql);
    return $query->fetch_assoc();
}

/**
 * Hàm thực hiện insert dữ liệu vào bảng
 *
 * Việc insert vào database là rất thường xuyên xảy ra
 * Nhưng cứ mỗi lần thực hiện thao tác insert chúng ta lại phải viết
 * câu lệnh SQL dạng như "INSERT INTO...". Điều này là vô cùng mất 
 * thời gian và có thể tiềm ẩn gây ra lỗi, chính vì thế tôi đã tạo 
 * hàm này để quá trình thêm dữ liệu vào database trở nên đơn giản hơn
 *
 * Để thực hiện thêm dữ liệu vào database. Bạn cần xác định trước hai thông tin:
 * 1. tên bảng bạn muốn insert
 * 2. các cột và giá trị của các cột tương ứng
 * 
 * Ví dụ. tôi sẽ insert thông tin vào bảng users, thì phải thực hiện như sau
 * $data = array(
 *     'name' => 'admin',
 *     'full_name' => 'Phạm Quang Bình',
 *     'password' => '******'
 * );
 * db_insert('users', $data);
 *
 * Tham khảo thêm
 * @url https://www.w3schools.com/php/func_array_keys.asp
 * @url https://www.w3schools.com/php/func_array_values.asp
 * @url https://www.w3schools.com/php/func_array_map.asp
 * @url https://www.w3schools.com/php/func_string_implode.asp
 * 
 * @param  string $table bảng cần insert
 * @param  data $data  mảng chứa dữ liệu cần insert
 * @return void
 */
function db_insert ($table, $data) {
    global $db;
    $fields = array_keys($data);
    $values = array_values($data);
    
    $fields = array_map(function ($value) {
        return "`$value`";
    }, $fields);

    $values = array_map(function ($value) {
        return "'$value'";
    }, $values);

    $fields = implode(', ', $fields);
    $values = implode(', ', $values);

    $sql = "INSERT INTO $table ($fields) VALUES($values)";

    $db->query($sql);
}

/**
 * Hàm thực hiện cập nhật trong database
 *
 * Bạn có thể xem ví dụ về cách sử dụng trong models/user.php@update_user
 * 
 * @param  string $table Tên bảng
 * @param  array $data  mảng chứa dữ liệu mới
 * @param  string $where điều kiện để cập nhật
 * @return void
 */
function db_update ($table, $data, $where) {
    global $db;
    $sql = "UPDATE $table SET ";

    $i = 1;
    foreach ($data as $column => $value) {
        $sql .="`$column` = '$value' ";

        if ($i < count($data)) {
            $sql .= ", ";
        }

        $i++;
    }

    $sql .= " WHERE $where";
    
    $db->query($sql);
}

/**
 * Hàm thực hiện xóa dữ liệu trong database
 *
 * Bạn có thể xem ví dụ về cách sử dụng trong models/user.php@delete_user
 * 
 * @param  string $table tên bảng
 * @param  string $where điều kiện xóa
 * @return void
 */
function db_delete ($table, $where) {
    global $db;
    $sql = "DELETE FROM $table WHERE $where";
    $db->query($sql);
}