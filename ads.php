<?php
// Простая страница с формой обратной связи на PHP

// Инициализация переменных для хранения ошибок и сообщений
$errors = [];
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы и очищаем их
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Валидация имени
    if (empty($name)) {
        $errors['name'] = "Пожалуйста, введите ваше имя.";
    } elseif (mb_strlen($name) < 2) {
        $errors['name'] = "Имя должно быть не короче 2 символов.";
    }

    // Валидация email
    if (empty($email)) {
        $errors['email'] = "Пожалуйста, введите email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Неверный формат email.";
    }

    // Валидация сообщения
    if (empty($message)) {
        $errors['message'] = "Пожалуйста, введите сообщение.";
    } elseif (mb_strlen($message) < 10) {
        $errors['message'] = "Сообщение должно быть не короче 10 символов.";
    }

    // Если ошибок нет, отправляем письмо
    if (empty($errors)) {
        $to = "your-email@example.com"; // Замените на свой email
        $subject = "Новое сообщение с сайта от $name";
        $body = "Имя: $name\nEmail: $email\n\nСообщение:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\n";

        // Отправка письма
        if (mail($to, $subject, $body, $headers)) {
            $success = "Спасибо! Ваше сообщение отправлено.";
            // Очищаем поля формы после успешной отправки
            $name = $email = $message = '';
        } else {
            $errors['send'] = "Ошибка при отправке письма. Попробуйте позже.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Форма обратной связи</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        form { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        label { display: block; margin-top: 15px; }
        input[type=text], input[type=email], textarea {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;
            box-sizing: border-box;
        }
        textarea { resize: vertical; height: 120px; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1em; margin-bottom: 15px; }
        button { margin-top: 20px; padding: 10px 20px; background: #007BFF; border: none; color: white; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Свяжитесь с нами</h2>

<?php if ($success): ?>
    <p class="success"><?=htmlspecialchars($success)?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" value="<?=htmlspecialchars($name ?? '')?>" />
    <?php if (!empty($errors['name'])): ?>
        <p class="error"><?=htmlspecialchars($errors['name'])?></p>
    <?php endif; ?>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?=htmlspecialchars($email ?? '')?>" />
    <?php if (!empty($errors['email'])): ?>
        <p class="error"><?=htmlspecialchars($errors['email'])?></p>
    <?php endif; ?>

    <label for="message">Сообщение:</label>
    <textarea id="message" name="message"><?=htmlspecialchars($message ?? '')?></textarea>
    <?php if (!empty($errors['message'])): ?>
        <p class="error"><?=htmlspecialchars($errors['message'])?></p>
    <?php endif; ?>

    <?php if (!empty($errors['send'])): ?>
        <p class="error"><?=htmlspecialchars($errors['send'])?></p>
    <?php endif; ?>

    <button type="submit">Отправить</button>
</form>

</body>
</html>
