let mesasPorSeccion = {};
let mesasNoDisponibles = {};
let seccionSeleccionada = 'principal';

const btnSalaPrincipal = document.getElementById("btn-sala-principal");
const btnSalaExterior = document.getElementById("btn-sala-exterior");
const contenedorMesas = document.getElementById("contenedor-mesas");

fetch('/backend/mesas-disponibles.php')
    .then(r => r.json())
    .then(data => {
        mesasPorSeccion = data;
        cargarMesas(seccionSeleccionada);
    });

function obtenerMesasNoDisponibles(fecha, hora) {
    fetch(`/backend/mesas-no-disponibles.php?fecha=${fecha}&hora=${hora}`)
        .then(res => res.json())
        .then(data => {
            mesasNoDisponibles = data;
            cargarMesas(seccionSeleccionada);
            console.log("Mesas no disponibles cargadas:", mesasNoDisponibles);
        })
        .catch(err => {
            console.error("Error al obtener mesas no disponibles:", err);
        });
}

function iniciarSeccionMesas(fecha, hora) {
    btnSalaPrincipal.classList.add('activo');
    btnSalaExterior.classList.remove('activo');
    seccionSeleccionada = 'principal';
    obtenerMesasNoDisponibles(fecha, hora);
}

function cargarMesas(seccion) {
    seccionSeleccionada = seccion;
    contenedorMesas.innerHTML = '';

    if (!mesasPorSeccion[seccion]) return;

    const todas = mesasPorSeccion[seccion];
    const noDisponibles = mesasNoDisponibles[seccion] || [];

    todas.forEach(mesa => {
        const btn = document.createElement('button');
        btn.textContent = `Mesa ${mesa.numero}`;
        btn.className = 'btn-mesa';

        if (noDisponibles.includes(mesa.id)) {
            btn.classList.add('no-disponible');
            btn.disabled = true;
        } else {
            btn.classList.add('disponible');
            btn.addEventListener('click', () => {
                datos.mesa_id = mesa.id;
                datos.zona_id = mesa.zona_id;

                const eventoMesa = new CustomEvent("mesa-seleccionada", {
                    detail: {
                        mesa_id: mesa.id,
                        zona_id: mesa.zona_id
                    }
                });
                document.dispatchEvent(eventoMesa);
            });
        }

        contenedorMesas.appendChild(btn);
    });
}

btnSalaPrincipal.addEventListener('click', () => {
    btnSalaPrincipal.classList.add('activo');
    btnSalaExterior.classList.remove('activo');
    cargarMesas('principal');
});

btnSalaExterior.addEventListener('click', () => {
    btnSalaExterior.classList.add('activo');
    btnSalaPrincipal.classList.remove('activo');
    cargarMesas('exterior');
});