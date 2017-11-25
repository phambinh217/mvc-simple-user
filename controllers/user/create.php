<?php

include '../../core.php';
include '../../models/user.php';

$errors = array();
$user = array(
    'name' => '',
    'full_name' => '',
    'password' => '',
);

if (isset($_POST['save'])) {
    $user['name'] = isset($_POST['name']) ? $_POST['name'] : '';
    $user['full_name'] = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $user['password'] = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($user['name'])) {
        $errors['name'] = 'Tên nick không được để trống';
    }

    if (empty($user['full_name'])) {
        $errors['full_name'] = 'Tên thật không được để trống';
    }

    if (empty($user['password'])) {
        $errors['password'] = 'Mật khẩu không được để trống';
    }

    if (!$errors) {
        $data = array('name' => $user['name'], 'full_name' => $user['full_name'], 'password' => $user['password']);
        create_user($data);
        header("Location: index.php");
    }
}

include '../../views/user/create.php';
