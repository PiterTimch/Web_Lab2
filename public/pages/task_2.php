<?php
declare(strict_types=1);

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_raw = isset($_POST['n']) ? trim($_POST['n']) : '';

    if ($n_raw === '' || !ctype_digit($n_raw)) {
        $error = "Будь ласка, введіть коректне натуральне число.";
    } else {
        $clean_n = ltrim($n_raw, '0');
        
        if ($clean_n === '') {
            $result = $n_raw === '' ? null : '0';
        } else {
            $result = strrev($clean_n);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 2</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Завдання №2</h1>
    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($result !== null): ?>
            <div class="alert alert-success" style="word-wrap: break-word;">
                Результат: <strong><?= htmlspecialchars($result) ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="n">Введіть число n:</label>
                <input type="text" name="n" id="n" value="<?= htmlspecialchars($_POST['n'] ?? '') ?>" required>
            </div>
            <button type="submit" class="submit-btn">Перевернути</button>
        </form>
        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>
</body>
</html>