<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thành viên</title>
    <style type="text/css">
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Users: Chỉnh sửa</h1>
    <form action="" method="POST">
        <table border="1">
            <tr>
                <td>Nick</td>
                <td>
                    <input type="text" name="name" value="<?php echo htmlentities($user['name']) ?>">
                    <?php if (isset($errors['name'])) : ?>
                        <p class="error"><?php echo $errors['name'] ?></p>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td>Tên đầy đủ</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo htmlentities($user['full_name']) ?>">
                    <?php if (isset($errors['full_name'])) : ?>
                        <p class="error"><?php echo $errors['full_name'] ?></p>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button name="save" type="submit">Lưu</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>