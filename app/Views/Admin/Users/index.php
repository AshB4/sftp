<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Users List</h2>

    <!-- Display flash messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('info') ?></div>
    <?php endif; ?>

    <!-- Users table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Active Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['id']) ?></td>
                <td><?= esc($user['name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
                <td>
                    <!-- Action to toggle user status -->
                    <a href="<?= site_url('admin/users/toggle/' . $user['id']) ?>" class="btn btn-sm btn-warning">
                        Toggle Active Status
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
