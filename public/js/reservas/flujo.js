document.addEventListener('DOMContentLoaded', function () {
    const btnDatos = document.getElementById('btn-datos');
    const btnPersonas = document.getElementById('btn-personas');
    const btnFecha = document.getElementById('btn-fecha');
    const btnHora = document.getElementById('btn-hora');
    const btnMesa = document.getElementById('btn-mesa');

    const seccionDatos = document.getElementById('seccion-datos');
    const seccionPersonas = document.getElementById('seccion-personas');
    const seccionFecha = document.getElementById('seccion-fecha');
    const seccionHora = document.getElementById('seccion-hora');
    const seccionMesa = document.getElementById('seccion-mesa');

    let datos = {};
    let personas = 0;

    disableButton(btnDatos);
    disableButton(btnPersonas);
    disableButton(btnFecha);
    disableButton(btnHora);
    disableButton(btnMesa); 

    function showStep(step) {
        seccionDatos.classList.add('hidden');
        seccionPersonas.classList.add('hidden');
        seccionFecha.classList.add('hidden');
        seccionHora.classList.add('hidden');
        seccionMesa.classList.add('hidden');

        btnDatos.classList.remove('activo');
        btnPersonas.classList.remove('activo');
        btnFecha.classList.remove('activo');
        btnHora.classList.remove('activo');
        btnMesa.classList.remove('activo');

        switch (step) {
            case 1:
                seccionDatos.classList.remove('hidden');
                btnDatos.classList.add('activo');
                break;
            case 2:
                seccionPersonas.classList.remove('hidden');
                btnPersonas.classList.add('activo');
                break;
            case 3:
                seccionFecha.classList.remove('hidden');
                btnFecha.classList.add('activo');
                break;
            case 4:
                seccionHora.classList.remove('hidden');
                btnHora.classList.add('activo');
                break;
            case 5:
                seccionMesa.classList.remove('hidden');
                btnMesa.classList.add('activo');
                break;
            default:
                break;
        }
    }

    function disableButton(button) {
        button.disabled = true;
        button.style.pointerEvents = 'none';
    }

    function enableButton(button) {
        button.disabled = false;
        button.style.pointerEvents = 'auto';
    }

    document.getElementById('formulario-reserva').addEventListener('submit', function (e) {
        e.preventDefault();

        datos.nombre = document.getElementById('nombre').value;
        datos.apellidos = document.getElementById('apellidos').value;
        datos.telefono = document.getElementById('telefono').value;
        datos.email = document.getElementById('email').value;

        if (!datos.nombre || !datos.apellidos || !datos.telefono || !datos.email) {
            alert('Por favor, ingrese todos los datos.');
            return;
        }

        showStep(2);
    });

    const botonesPersonas = document.querySelectorAll('.boton-personas');
    botonesPersonas.forEach(boton => {
        boton.addEventListener('click', function () {
            personas = parseInt(boton.textContent);

            botonesPersonas.forEach(b => b.classList.remove('activo'));
            boton.classList.add('activo');

            showStep(3);
        });
    });

    btnDatos.addEventListener('click', function () { showStep(1); });
    btnPersonas.addEventListener('click', function () { showStep(2); });
    btnFecha.addEventListener('click', function () { showStep(3); });
    btnHora.addEventListener('click', function () { showStep(4); });
    btnMesa.addEventListener('click', function () { showStep(5); });

    // Mostrar el primer paso al cargar la página
    showStep(1);
});