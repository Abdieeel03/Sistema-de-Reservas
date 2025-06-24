document.getElementById('form').addEventListener('submit', function (e) {
    e.preventDefault();

    let valid = true;

    const nombre = document.getElementById('nombre');
    const errorNombre = document.getElementById('error-nombre');
    if (nombre.value.trim() === '') {
        errorNombre.textContent = 'Por favor, ingresa tu nombre.';
        valid = false;
    } else {
        errorNombre.textContent = '';
    }

    const email = document.getElementById('email');
    const errorEmail = document.getElementById('error-email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value.trim())) {
        errorEmail.textContent = 'Por favor, ingresa un correo válido.';
        valid = false;
    } else {
        errorEmail.textContent = '';
    }

    const mensaje = document.getElementById('mensaje');
    const errorMensaje = document.getElementById('error-mensaje');
    if (mensaje.value.trim() === '') {
        errorMensaje.textContent = 'Por favor, escribe tu mensaje.';
        valid = false;
    } else {
        errorMensaje.textContent = '';
    }

    if (valid) {
        const formData = new FormData(this);

        fetch('backend/send-message.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Mensaje recibido:\nNombre: ' + data.nombre + '\nEmail: ' + data.email + '\nMensaje: ' + data.mensaje);
                    this.reset();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Hubo un error al enviar el mensaje. Inténtalo de nuevo más tarde.');
                console.error("Error:", error);
            });
    }
});