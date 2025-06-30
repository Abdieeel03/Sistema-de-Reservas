let horasPorFranja = {};
let horasNoDisponibles = {};
let franjaSeleccionada = 'dia';

fetch('/backend/horas-disponibles.php')
    .then(r => r.json())
    .then(data => {
        horasPorFranja = data;
        cargarHoras(franjaSeleccionada);
    });

const botonesCabecera = document.querySelectorAll('.btn-cabecera');
const contenedorHoras = document.getElementById('contenedor-horas');

// Función para cargar horas no disponibles por fecha
function obtenerHorasNoDisponibles(fecha) {
    fetch(`/backend/horarios-no-disponibles.php?fecha=${fecha}`)
        .then(res => res.json())
        .then(data => {
            horasNoDisponibles = data;
            cargarHoras(franjaSeleccionada);
            console.log("Horarios no disponibles cargados:", horasNoDisponibles);
        })
        .catch(err => {
            console.error("Error al cargar horarios no disponibles:", err);
        });
}

function iniciarSeccionHoras(fecha) {
    botonesCabecera.forEach(btn => btn.classList.remove('activo'));
    document.getElementById('btn-dia').classList.add('activo');
    franjaSeleccionada = 'dia';
    obtenerHorasNoDisponibles(fecha);
}

function cargarHoras(franja) {
    franjaSeleccionada = franja;
    contenedorHoras.innerHTML = '';

    if (!horasPorFranja[franja]) return;

    const todasLasHoras = horasPorFranja[franja];
    const noDisponibles = horasNoDisponibles[franja] || [];

    for (let i = 0; i < todasLasHoras.length; i += 3) {
        const fila = document.createElement('div');
        fila.className = 'fila-horas';

        const grupo = todasLasHoras.slice(i, i + 3);
        grupo.forEach(horaObj => {
            const btn = document.createElement('button');
            btn.textContent = horaObj.hora;
            btn.className = 'btn-hora';

            if (noDisponibles.includes(horaObj.hora)) {
                btn.classList.add('no-disponible');
                btn.disabled = true;
            } else {
                btn.classList.add('disponible');
                btn.addEventListener('click', () => {
                    datos.hora = horaObj.hora;
                    datos.horario_id = horaObj.id;

                    const eventoHora = new CustomEvent("hora-seleccionada", {
                        detail: {
                            hora: horaObj.hora,
                            id: horaObj.id
                        }
                    });
                    document.dispatchEvent(eventoHora);
                });
            }

            fila.appendChild(btn);
        });
        contenedorHoras.appendChild(fila);
    }
}

botonesCabecera.forEach(btn => {
    btn.addEventListener('click', () => {
        botonesCabecera.forEach(b => b.classList.remove('activo'));
        btn.classList.add('activo');
        cargarHoras(btn.id.replace('btn-', ''));
    });
});