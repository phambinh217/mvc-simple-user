<?php

include '../../core.php';
include '../../models/user.php';

$errors = array();

$user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : false;
if ($user_id) {
    delete_user($user_id);
}

header("location: index.php");