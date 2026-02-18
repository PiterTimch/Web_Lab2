<?php
declare(strict_types=1);

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = filter_input(INPUT_POST, 'a', FILTER_VALIDATE_FLOAT);
    $b = filter_input(INPUT_POST, 'b', FILTER_VALIDATE_FLOAT);
    $m = filter_input(INPUT_POST, 'm', FILTER_VALIDATE_FLOAT);

    if ($a === false || $b === false || $m === false || $a === null || $b === null || $m === null) {
        $error = "Будь ласка, введіть коректні числові значення.";
    } elseif ($m <= 0) {
        $error = "Помилка: Логарифм ln(m) визначений тільки для m > 0.";
    } else {
        $denominator = $b * cos($b);
        if (abs($denominator) < 1e-9) {
            $error = "Помилка: Ділення на нуль (знаменник b * cos(b) дорівнює 0).";
        } else {
            $numerator = ($m * log($m)) + ($a * sin($a * $m));
            $result = $numerator / $denominator;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 1</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Завдання №1</h1>

    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($result !== null): ?>
            <div class="alert alert-success">
                Результат: <strong><?= round($result, 4) ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="a">Параметр a:</label>
                <input type="text" name="a" id="a" value="<?= $_POST['a'] ?? '3' ?>" required>
            </div>
            <div class="input-group">
                <label for="b">Параметр b:</label>
                <input type="text" name="b" id="b" value="<?= $_POST['b'] ?? '21' ?>" required>
            </div>
            <div class="input-group">
                <label for="m">Параметр m:</label>
                <input type="text" name="m" id="m" value="<?= $_POST['m'] ?? '3.27' ?>" required>
            </div>
            <button type="submit" class="submit-btn">Обчислити</button>
        </form>

        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>

</body>
</html>