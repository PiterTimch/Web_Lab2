<?php
declare(strict_types=1);

$result = null;
$error = null;

function getTextBeforeToken(string $text, string $token): ?string {
    $pos = strpos($text, $token);
    if ($pos === false) {
        return null;
    }
    return substr($text, 0, $pos);
}

function isLatinOnly(string $text): bool {
    return (bool)preg_match('/^[a-zA-Z0-9\s\.,!\?\-]+$/', $text);
}

function validateEnding(string $text): bool {
    return str_ends_with(trim($text), '.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['text_input'] ?? '';

    if (!validateEnding($input)) {
        $error = "Текст повинен закінчуватися крапкою.";
    } elseif (!isLatinOnly(rtrim($input, '.'))) {
        $error = "Помилка: дозволена тільки латиниця!";
    } else {
        $clean_text = rtrim(trim($input), '.');
        $processed = getTextBeforeToken($clean_text, "rtf");

        if ($processed === null) {
            $error = "Поєднання літер 'rtf' не знайдено в тексті.";
        } else {
            $result = $processed === '' ? "[Порожній рядок (rtf на початку)]" : $processed;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 6</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Завдання №6</h1>

    <div class="form-container">
        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($result !== null): ?>
            <div class="alert alert-success">
                Текст до "rtf":<br>
                <strong><?= htmlspecialchars($result) ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="text_input">Введіть латинський текст (з крапкою в кінці):</label>
                <input type="text" name="text_input" id="text_input" placeholder="ExampleRtfText." value="<?= htmlspecialchars($_POST['text_input'] ?? '') ?>" required>
            </div>
            <button type="submit" class="submit-btn">Обробити</button>
        </form>

        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>

</body>
</html>