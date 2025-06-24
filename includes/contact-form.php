<section id="contacto" class="seccion-container">
    <div class="contacto-title-container">
        <h3 class="contacto-title-text">¡Te escuchamos!</h3>
        <p class="contacto-title-subtext">Déjanos un comentario sobre el servicio</p>
    </div>
    <form id="form" action="backend/send-message.php" method="POST" class="contacto-form-container" novalidate>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
        <span class="error-message" id="error-nombre"></span>

        <input type="email" id="email" name="email" placeholder="Tu correo electrónico" required>
        <span class="error-message" id="error-email"></span>

        <textarea name="mensaje" id="mensaje" placeholder="Escribe tu mensaje aquí" rows="8"
            required></textarea>
        <span class="error-message" id="error-mensaje"></span>

        <button type="submit">Enviar <i class="fa-solid fa-chevron-right"></i></button>
    </form>
</section>