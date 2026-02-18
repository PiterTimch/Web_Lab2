<?php
declare(strict_types=1);

$rows = 2;
$cols = 20;
$matrix = [];
$sum = 0;
$average = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $num = rand(1, 100);
            $matrix[$i][$j] = $num;
            $sum += $num;
        }
    }
    $average = $sum / ($rows * $cols);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 4</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Завдання №4 (Масив L 2x20)</h1>

    <div class="form-container wide">
        <form method="POST">
            <button type="submit" class="submit-btn">Згенерувати масив та обчислити</button>
        </form>

        <?php if ($average !== null): ?>
            <div class="matrix-wrapper">
                <table>
                    <?php foreach ($matrix as $row): ?>
                        <tr>
                            <?php foreach ($row as $val): ?>
                                <td><?= $val ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="alert alert-success">
                Середнє арифметичне 40 елементів: <strong><?= round($average, 4) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>

</body>
</html>