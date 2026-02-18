<?php
declare(strict_types=1);

$result_s = null;
$max_a = null;
$max_b = null;
$error = null;

function getArrayMax(array $arr): float {
    return (float)max($arr);
}

function compareMaximus(float $maxA, float $maxB): int {
    if ($maxA > $maxB) return -1;
    if ($maxA === $maxB) return 0;
    return 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw_a = $_POST['array_a'] ?? '';
    $raw_b = $_POST['array_b'] ?? '';

    $data_a = array_filter(array_map('trim', explode(',', $raw_a)), 'is_numeric');
    $data_b = array_filter(array_map('trim', explode(',', $raw_b)), 'is_numeric');

    if (count($data_a) !== 5 || count($data_b) !== 5) {
        $error = "Будь ласка, введіть рівно по 5 чисел для кожного масиву.";
    } else {
        $max_a = getArrayMax(array_map('floatval', $data_a));
        $max_b = getArrayMax(array_map('floatval', $data_b));
        $result_s = compareMaximus($max_a, $max_b);
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 5 - Порівняння масивів</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Завдання №5</h1>

    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($result_s !== null): ?>
            <div class="alert alert-success">
                Max A: <strong><?= $max_a ?></strong><br>
                Max B: <strong><?= $max_b ?></strong><br>
                Значення S: <strong><?= $result_s ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="array_a">Масив A (5 чисел через кому):</label>
                <input type="text" name="array_a" id="array_a" placeholder="1, 5, 3, 8, 2" value="<?= htmlspecialchars($_POST['array_a'] ?? '') ?>" required>
            </div>
            <div class="input-group">
                <label for="array_b">Масив B (5 чисел через кому):</label>
                <input type="text" name="array_b" id="array_b" placeholder="4, 2, 9, 1, 7" value="<?= htmlspecialchars($_POST['array_b'] ?? '') ?>" required>
            </div>
            <button type="submit" class="submit-btn">Порівняти</button>
        </form>

        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>

</body>
</html>