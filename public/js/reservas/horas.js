let horasPorFranja = {};
let horasNoDisponibles = {};
let franjaSeleccionada = 'dia';

// Cargar horas disponibles por franja (todas)
fetch('/backend/horas-disponibles.php')
    .then(r => r.json())
    .then(data => {
        horasPorFranja = data;
        cargarHoras(franjaSeleccionada); // Día por defecto
    });

const botonesCabecera = document.querySelectorAll('.btn-cabecera');
const contenedorHoras = document.getElementById('contenedor-horas');

// Función para cargar horas no disponibles por fecha
function obtenerHorasNoDisponibles(fecha) {
    fetch(`/backend/horarios-no-disponibles.php?fecha=${fecha}`)
        .then(res => res.json())
        .then(data => {
            horasNoDisponibles = data;
            cargarHoras(franjaSeleccionada); // Recargar con restricciones
            console.log("Horarios no disponibles cargados:", horasNoDisponibles);
        })
        .catch(err => {
            console.error("Error al cargar horarios no disponibles:", err);
        });
}

// Mostrar los botones de hora por franja
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
        grupo.forEach(hora => {
            const btn = document.createElement('button');
            btn.textContent = hora;
            btn.className = 'btn-hora';

            if (noDisponibles.includes(hora)) {
                btn.classList.add('no-disponible');
                btn.disabled = true;
            } else {
                btn.classList.add('disponible');
                btn.addEventListener('click', () => {
                    datos.hora = hora;
                    const eventoHora = new CustomEvent("hora-seleccionada", {
                        detail: { hora: hora }
                    });
                    document.dispatchEvent(eventoHora);
                });
            }

            fila.appendChild(btn);
        });

        contenedorHoras.appendChild(fila);
    }
}

// Botones de franja: Día, Tarde, Noche
botonesCabecera.forEach(btn => {
    btn.addEventListener('click', () => {
        botonesCabecera.forEach(b => b.classList.remove('activo'));
        btn.classList.add('activo');
        cargarHoras(btn.id.replace('btn-', ''));
    });
});