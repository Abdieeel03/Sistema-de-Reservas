<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        window.datos = {};
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/global.css">
    <link rel="stylesheet" href="/public/css/reservas.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reserva en Siete Sopas</title>
</head>

<body>
    <header>
        <a href="/index.php" class="logo-container">
            <img src="/public/img/logo-sietesopas.webp" alt="logo de siete sopas" class="logo-img">
            <h4 class="logo-name">Siete Sopas</h4>
        </a>
    </header>

    <nav class="pasos-reserva">
        <ul>
            <li id="btn-datos" class="paso activo" data-step="1"><i class="fa-solid fa-circle-info"></i>Tus datos</li>
            <li id="btn-personas" class="paso" data-step="2"><i class="fa-solid fa-person"></i>Personas</li>
            <li id="btn-fecha" class="paso" data-step="3"><i class="fa-solid fa-calendar"></i>Fecha</li>
            <li id="btn-hora" class="paso" data-step="4"><i class="fa-solid fa-clock"></i>Hora</li>
            <li id="btn-mesa" class="paso" data-step="5"><i class="fa-solid fa-receipt"></i>Mesa</li>
        </ul>
    </nav>

    <main class="secciones-reserva">

        <section id="seccion-datos" class="seccion-reserva activo">
            <div id="container-datos" class="container">
                <div class="titulo">
                    <h4>Ingrese sus datos:</h4>
                </div>
                <div class="form-container">
                    <form id="formulario-reserva" novalidate>
                        <div class="inputs">
                            <div class="input-container">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre">
                            </div>
                            <div class="input-container">
                                <label for="dni">Dni:</label>
                                <input type="text" id="dni" name="dni">
                            </div>
                        </div>
                        <div class="inputs">
                            <div class="input-container">
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" id="telefono" name="telefono">
                            </div>
                            <div class="input-container">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email">
                            </div>
                        </div>
                        <div class="terminos-condiciones">
                            <div class="input-container">
                                <input type="checkbox" id="terminos" name="terminos">
                                <label for="terminos">Acepto los <a href="/docs/terminos.html"
                                        target="_blank">términos y condiciones</a></label>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit">Continuar <i class="fa fa-chevron-right"
                                    aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="seccion-personas" class="seccion-reserva">
            <div class="container">
                <div class="titulo">
                    <h4>Elija la cantidad de personas:</h4>
                </div>
                <div class="botones-container" id="botones-container">
                    <div class="fila">
                        <button type="button" class="boton-personas">1</button>
                        <button type="button" class="boton-personas">2</button>
                        <button type="button" class="boton-personas">3</button>
                        <button type="button" class="boton-personas">4</button>
                        <button type="button" class="boton-personas">5</button>
                        <button type="button" class="boton-personas">6</button>
                    </div>
                </div>
                <div class="botones">
                    <button id="btn-volver" class="btn-volver">Volver</button>
                </div>
        </section>

        <section id="seccion-fecha" class="seccion-reserva">
            <div class="container">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button id="prev">&#10094;</button>
                        <h4 id="monthYear"></h4>
                        <button id="next">&#10095;</button>
                    </div>
                    <div class="calendar-days" id="calendarDays"></div>
                    <div class="calendar-dates" id="calendarDates"></div>
                </div>
                <div class="botones">
                    <button id="btn-volver" class="btn-volver">Volver</button>
                </div>
            </div>
        </section>

        <section id="seccion-hora" class="seccion-reserva">
            <div class="container">
                <div class="titulo">
                    <h4>Seleccione una hora:</h4>
                </div>
                <div class="botones-horas">
                    <div class="cabecera">
                        <button type="button" id="btn-dia" class="btn-cabecera activo">Día</button>
                        <button type="button" id="btn-tarde" class="btn-cabecera">Tarde</button>
                        <button type="button" id="btn-noche" class="btn-cabecera">Noche</button>
                    </div>
                    <div id="contenedor-horas" class="horas"></div>
                </div>
                <div class="botones">
                    <button id="btn-volver" class="btn-volver">Volver</button>
                </div>
            </div>
        </section>

        <section id="seccion-mesa" class="seccion-reserva">
            <div class="container">
                <div class="titulo">
                    <h4>Seleccione una mesa:</h4>
                </div>
                <div class="botones-mesas">
                    <div class="cabecera">
                        <button type="button" id="btn-sala-principal" class="btn-cabecera activo">Sala
                            principal</button>
                        <button type="button" id="btn-sala-exterior" class="btn-cabecera no-activo">Sala
                            exterior</button>
                    </div>
                    <div id="contenedor-mesas" class="mesas"></div>
                </div>
                <div class="botones">
                    <button id="btn-volver" class="btn-volver">Volver</button>
                </div>
            </div>
        </section>

        <section id="seccion-resumen" class="seccion-reserva hidden">
            <div class="container-resumen">
                <h3>Resumen de tu reserva</h3>
                <div class="resumen-datos">
                    <p><strong>Nombre:</strong> <span id="resumen-nombre"></span></p>
                    <p><strong>DNI:</strong> <span id="resumen-dni"></span></p>
                    <p><strong>Teléfono:</strong> <span id="resumen-telefono"></span></p>
                    <p><strong>Email:</strong> <span id="resumen-email"></span></p>
                    <p><strong>Personas:</strong> <span id="resumen-personas"></span></p>
                    <p><strong>Fecha:</strong> <span id="resumen-fecha"></span></p>
                    <p><strong>Hora:</strong> <span id="resumen-hora"></span></p>
                    <p><strong>Mesa:</strong> <span id="resumen-mesa"></span></p>
                    <p><strong>Zona:</strong> <span id="resumen-zona"></span></p>
                </div>

                <div class="botones">
                    <button id="btn-confirmar-reserva" class="btn-confirmar">Confirmar Reserva</button>
                    <button id="btn-volver" class="btn-volver">Volver</button>
                </div>
            </div>
        </section>

    </main>

    <footer>
        © 2025 Siete Sopas. Todos los derechos reservados.
    </footer>

    <script src="/public/js/reservas/flujo.js""></script>
    <script src=" /public/js/reservas/calendario.js"></script>
    <script src="/public/js/reservas/horas.js"></script>
    <script src="/public/js/reservas/mesas.js"></script>

</body>

</html>