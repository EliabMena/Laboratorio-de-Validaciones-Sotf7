<?php
$name = htmlspecialchars(trim($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$captcha = htmlspecialchars(trim($_POST['captcha'] ?? ''));
$captcha_answer = htmlspecialchars(trim($_POST['captcha_answer'] ?? ''));

$errors = [];

// Validación del lado servidor
if ($name === '') {
    $errors[] = "El nombre es obligatorio.";
}
if ($email === '') {
    $errors[] = "El email es obligatorio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Formato de email inválido.";
}
if ($phone === '') {
    $errors[] = "El teléfono es obligatorio.";
} elseif (!preg_match('/^\d{8}$/', $phone)) {
    $errors[] = "El teléfono debe tener 8 dígitos numéricos.";
}
if ($captcha === '') {
    $errors[] = "El CAPTCHA es obligatorio.";
} elseif ($captcha != $captcha_answer) {
    $errors[] = "CAPTCHA incorrecto.";
}

if (!empty($errors)) {
    echo "ERROR:" . implode("<br>", $errors);
} else {
    echo "Form submitted successfully";
}
?>