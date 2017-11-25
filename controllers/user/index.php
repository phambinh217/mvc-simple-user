<?php

include '../../core.php';
include '../../models/user.php';

$users = get_all_users();

include '../../views/user/index.php';
