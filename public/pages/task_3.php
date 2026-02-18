<?php
declare(strict_types=1);

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = isset($_POST['numbers']) ? trim($_POST['numbers']) : '';

    if ($input === '') {
        $error = "Будь ласка, введіть числа.";
    } else {
        $items = explode(',', $input);
        $numbers = [];
        $isValid = true;

        foreach ($items as $item) {
            $item = trim($item);
            if ($item === '') continue;

            if (is_numeric($item)) {
                $numbers[] = (float)$item;
            } else {
                $isValid = false;
                break;
            }
        }

        if (!$isValid || empty($numbers)) {
            $error = "Помилка: введіть лише числа, розділені комами.";
        } else {
            $result = array_sum($numbers) / count($numbers);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 3</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Завдання №3</h1>
    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($result !== null): ?>
            <div class="alert alert-success">
                Середнє арифметичне: <strong><?= round($result, 4) ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="numbers">Введіть числа через кому:</label>
                <input type="text" name="numbers" id="numbers" placeholder="10, 20.5, 30" value="<?= htmlspecialchars($_POST['numbers'] ?? '') ?>" required>
            </div>
            <button type="submit" class="submit-btn">Обчислити</button>
        </form>
        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>
</body>
</html>