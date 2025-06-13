const formulario = document.getElementById('contactForm');

//escuchando el evento Submit
formulario.addEventListener('submit', function(e) {
    //detengo el envío del formulario
    e.preventDefault();
    //Al usar event.preventDefault();
    //detienes ese comportamiento automático, lo que te permite:
    //Capturar los datos del formulario manualmente.
    //enviarlos tú mismo
    //Mostrar resultados sin recargar la página.

    // Limpia errores previos
    document.getElementById('errors').innerHTML = '';

    // Validación del lado cliente
    let errores = [];
    const nombre = formulario.name.value.trim();
    const correo = formulario.email.value.trim();
    const telefono = formulario.phone.value.trim();
    const captchaUsuario = formulario.captcha.value.trim();
    const captchaCorrecto = formulario.captcha_answer.value.trim();

    if (nombre === '') {
        errores.push('El nombre es obligatorio.');
    }
    if (correo === '') {
        // Si el campo de correo electrónico está vacío,
        // agrega un mensaje de error al array de errores
        //para que se muestre al usuario
        //en la página web
        errores.push('El email es obligatorio.');
    } else if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(correo)) {
        errores.push('Formato de email inválido.');
    }
    if (telefono === '') { // Verifica si el campo está vacío
        // Si está vacío, agrega un mensaje de error
        // al array de errores
        //para que se muestre al usuario
        //en la página web
        errores.push('El teléfono es obligatorio.');
    } else if (!/^\d{8}$/.test(telefono)) {
        errores.push('El teléfono debe tener 8 dígitos numéricos.');
    }
    if (captchaUsuario === '') {
        errores.push('El CAPTCHA es obligatorio.');
    } else if (captchaUsuario !== captchaCorrecto) {
        errores.push('CAPTCHA incorrecto.');
    }

    if (errores.length > 0) {
        document.getElementById('errors').innerHTML = errores.join('<br>');
        return;
    }

    const datos = new FormData(formulario);
        //FormData: se usa para recoger todos los
    //de un formulario HTML y prepararlos para el envío
    //con fetch

    fetch(formulario.action, {
        method: 'POST',
        body: datos
    })
    //then que maneja la repuesta del servidor 
    //después de enviar el formulario con fetch
    //=>response.text() convierte la respuesta 
    //servidor en texto plano
    //.then(data=>{ recibe el texto procesado})
    //Luego inserta ese texto dentro del 
    //elemento con id response en el HTML
    .then(respuesta => respuesta.text())
    .then(resultado => {
        // Si la respuesta contiene errores, colócalos en #errors, si no, en #response
        if (resultado.startsWith('ERROR:')) {
            document.getElementById('errors').innerHTML = resultado.replace('ERROR:', '');
            document.getElementById('response').innerHTML = '';
        } else {
            document.getElementById('errors').innerHTML = '';
            document.getElementById('response').innerHTML = resultado;
            // Regenerar CAPTCHA tras éxito
            if (typeof generateCaptcha === 'function') generateCaptcha();
        }
    })
    .catch(() => {
        document.getElementById('errors').innerHTML = 'Error en el envío.';
    });
});