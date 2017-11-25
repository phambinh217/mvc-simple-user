<?php

function get_all_users () {
    $sql = "SELECT * FROM users";
    $results = db_select($sql);
    return $results;
}

function get_user ($user_id) {
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = db_first_row($sql);
    return $result;
}

function create_user ($data) {
    return db_insert('users', $data);
}

function update_user ($data, $user_id) {
    return db_update('users', $data, "id = $user_id");
}

function delete_user ($user_id) {
    return db_delete('users', "id = $user_id");
}