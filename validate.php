<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate name
    $name = test_input($_POST["name"]);
    $nameErr = "";
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Solo letras y espacios permitidos en el nombre";
    }
    
    // Sanitize and validate email
    $email = test_input($_POST["email"]);
    $emailErr = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Formato de email inválido";
    }
    
    // ... Additional validation checks ...

    if ($nameErr != "" || $emailErr != "") {
    echo "<b>Error:</b>";
    echo "<br>" . $nameErr;
    echo "<br>" . $emailErr;
     } else {
    // Procesar los datos del formulario
    echo "Formulario enviado con éxito";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>