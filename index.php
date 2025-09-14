<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Получаем данные пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Профиль</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Привет, <?php echo htmlspecialchars($user['username']); ?>!</h5>
                <p class="card-text">Роль: <?php echo $user['role'] === 'admin' ? 'Администратор' : 'Пользователь'; ?></p>
                <p class="card-text">Зарегистрирован: <?php echo $user['created_at']; ?></p>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php" class="btn btn-primary">Перейти в админ-панель</a>
                <?php endif; ?>
            </div>
        </div>
        <p class="mt-3"><a href="logout.php" class="btn btn-outline-secondary">Выйти</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>