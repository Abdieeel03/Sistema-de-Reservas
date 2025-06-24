<?php require_once('includes/header.php'); ?>

<main class="main-container">

    <section class="seccion-container hero">
        <div class="hero-background"></div>
        <div class="hero-text-container">
            <h1 class="hero-title">¡Bienvenido al nuevo sistema de reservas!</h1>
            <p>Acompañanos y prueba nuestras deliciosas sopas y segundos 👨‍🍳</p>
        </div>
    </section>

    <section id="nosotros" class="seccion-container">
        <div class="text-container">
            <h3>Sobre Nosotros 🔎🍜</h3>
            <p>
                En Siete Sopas creemos que una buena sopa puede reconfortar el alma. Desde nuestros inicios, nos
                propusimos rescatar los sabores de casa y convertir cada plato en una experiencia memorable. Nuestra
                carta, cuidadosamente seleccionada, ofrece una variedad de sopas tradicionales peruanas y del mundo,
                preparadas con ingredientes frescos y mucho cariño.
                ¡Bienvenido a Siete Sopas, donde cada cucharada tiene historia!
            </p>
        </div>
        <div class="imagen-container">
            <img src="./public/img/fondo-reservas.webp" alt="Restaurante Siete Sopas">
        </div>
    </section>

    <section id="carta" class="seccion-container">
        <div class="imagen-container">
            <img src="./public/img/img-lacarta.webp" alt="Restaurante Siete Sopas">
        </div>
        <div class="text-container">
            <h3>Nuestra Carta 🔎🍽️</h3>
            <p>
                Descubre todas las sopas y sabores que tenemos para ti. Desde clásicos peruanos
                hasta opciones internacionales, ¡encuentra tu favorita!
            </p>
            <a href="./public/resources/CartaSIETESOPAS.pdf" target="_blank">Ver Carta <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </div>
    </section>

    <?php require_once('includes/contact-form.php'); ?>

</main>

<?php require_once('includes/footer.php'); ?>