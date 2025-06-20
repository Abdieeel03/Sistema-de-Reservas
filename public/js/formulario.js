document.getElementById('form').addEventListener('submit', function (e) {
    e.preventDefault(); 

    let valid = true;

    // Nombre
    const nombre = document.getElementById('nombre');
    const errorNombre = document.getElementById('error-nombre');
    if (nombre.value.trim() === '') {
        errorNombre.textContent = 'Por favor, ingresa tu nombre.';
        valid = false;
    } else {
        errorNombre.textContent = '';
    }

    // Email
    const email = document.getElementById('email');
    const errorEmail = document.getElementById('error-email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value.trim())) {
        errorEmail.textContent = 'Por favor, ingresa un correo válido.';
        valid = false;
    } else {
        errorEmail.textContent = '';
    }

    // Mensaje
    const mensaje = document.getElementById('mensaje');
    const errorMensaje = document.getElementById('error-mensaje');
    if (mensaje.value.trim() === '') {
        errorMensaje.textContent = 'Por favor, escribe tu mensaje.';
        valid = false;
    } else {
        errorMensaje.textContent = '';
    }

    if (valid) {
        this.submit(); 
        this.reset(); // Limpia el formulario
    }
});
