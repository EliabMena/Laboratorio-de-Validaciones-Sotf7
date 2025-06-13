<!DOCTYPE html>
<html>
<head>
    <title>Validaciones con Fetch</title>
</head>
<body>

<h2>Ejemplo de Validaciones</h2>
<form id="contactForm" action="process.php" method="post" autocomplete="off">
    nombre: <input type="text" name="name"><br><br>
    email: <input type="text" name="email"><br><br>
    teléfono: <input type="text" name="phone" placeholder="61288699"><br><br>
    <label>CAPTCHA: <span id="captcha-question"></span></label>
    <input type="text" name="captcha" id="captcha"><br><br>
    <input type="hidden" name="captcha_answer" id="captcha_answer">
    <input type="submit" name="submit" value="Submit">
</form>
<div id="errors" style="color:red;"></div>
<div id="response"></div>
<script src="form-handler.js" defer></script>
<script>
// Generar pregunta CAPTCHA simple (suma)
function generateCaptcha() {
    const a = Math.floor(Math.random() * 10) + 1;
    const b = Math.floor(Math.random() * 10) + 1;
    document.getElementById('captcha-question').textContent = `${a} + ${b} = ?`;
    document.getElementById('captcha_answer').value = a + b;
}
generateCaptcha();
</script>
</body>
</html>