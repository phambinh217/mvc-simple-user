<!DOCTYPE html>
<html>
<head>
    <title>Danh sách thành viên</title>
</head>
<body>
    <h1>Users: Danh sách</h1>
    <p><a href="create.php">Thêm</a></p>
    <table border="1">
        <thead>
            <th>#</th>
            <th>ID</th>
            <th>Nick</th>
            <th>Tên thật</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td>#<?php echo $i ?></td>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['full_name'] ?></td>
                    <td><a href="edit.php?user_id=<?php echo $user['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc muốn xóa');" href="delete.php?user_id=<?php echo $user['id'] ?>">Xóa</a></td>
                </tr>
                <?php $i++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>