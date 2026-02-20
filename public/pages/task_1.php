<?php
declare(strict_types=1);

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['textfile'] ?? null;
    $filePath = $file['tmp_name'] ?? null;
    $fileName = $file['name'] ?? '';

    if (!$filePath || !is_uploaded_file($filePath)) {
        $error = "Будь ласка, завантажте текстовий файл.";
    } else {
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($extension !== 'txt') {
            $error = "Дозволені лише файли формату .txt";
        } else {
            $content = file_get_contents($filePath);
            if ($content === false) {
                $error = "Не вдалося прочитати файл.";
            } else {
                $result = strlen($content);
            }
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
                Кількість символів у файлі: <strong><?= $result ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="textfile">Завантажте текстовий файл:</label>
                <input type="file" name="textfile" id="textfile" accept=".txt" required>
            </div>
            <button type="submit" class="submit-btn">Порахувати символи</button>
        </form>

        <a href="../index.php" class="back-link">← Назад до списку</a>
    </div>
</body>
</html>
