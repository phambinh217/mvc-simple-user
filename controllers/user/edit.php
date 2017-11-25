<?php

include '../../core.php';
include '../../models/user.php';

$errors = array();

$user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : false;
if (!$user_id) {
    die('Not found');
}

$user = get_user($user_id);
if (!$user) {
    die('Not found');
}

if (isset($_POST['save'])) {
    $user['name'] = isset($_POST['name']) ? $_POST['name'] : '';
    $user['full_name'] = isset($_POST['full_name']) ? $_POST['full_name'] : '';

    if (empty($user['name'])) {
        $errors['name'] = 'Tên nick không được để trống';
    }

    if (empty($user['full_name'])) {
        $errors['full_name'] = 'Tên thật không được để trống';
    }

    if (!$errors) {
        $data = array('name' => $user['name'], 'full_name' => $user['full_name']);
        update_user($data, $user_id);
        header("Location: index.php");
    }
}

include '../../views/user/edit.php';
