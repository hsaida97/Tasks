<?php
$modelFile = 'app/Models/user.php';
require_once $modelFile;
$user = new User();
$action = $_GET['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);


    if ($action === 'edit' && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $updated = $user->where('id', '=', $id)->update(['name' => $name, 'email' => $email]);

        if ($updated) {
            header("Location: ?page=user");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error updating record.</div>";
        }
    } elseif ($action === 'create') {
        $created = $user->create([ 'name' => $name, 'email' => $email]);

        if ($created) {
            header("Location: ?page=user");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error creating record.</div>";
        }
    }
}

if (is_null($action)) {
    require_once __DIR__ . '/users.php';
} elseif ($action == 'edit') {
    require_once __DIR__ . '/user-edit.php';
} elseif ($action == 'delete') {
    require_once __DIR__ . '/user-delete.php';
} elseif ($action == 'create') {
    require_once __DIR__ . '/user-create.php';
}
