const horasPorFranja = {
    dia: ['09:00', '10:00', '11:00'],
    tarde: ['12:00', '13:00', '14:00', '15:00', '16:00', '17:00'],
    noche: ['18:00', '20:00', '21:00', '22:00', '23:00']
};
const horasDisponibles = {
    dia: ['09:00', '09:30', '10:00'],
    tarde: ['12:30', '14:00', '15:30', '17:00'],
    noche: ['19:30', '21:00', '22:30']
};

const botonesCabecera = document.querySelectorAll('.btn-cabecera');
const contenedorHoras = document.getElementById('contenedor-horas');

function cargarHoras(franja) {
    contenedorHoras.innerHTML = '';
    const todasLasHoras = horasPorFranja[franja];
    const disponibles = horasDisponibles[franja];

    for (let i = 0; i < todasLasHoras.length; i += 3) {
        const fila = document.createElement('div');
        fila.className = 'fila-horas';

        const grupo = todasLasHoras.slice(i, i + 3);
        grupo.forEach(hora => {
            const btn = document.createElement('button');
            btn.textContent = hora;
            btn.className = 'btn-hora';

            if (disponibles.includes(hora)) {
                btn.classList.add('disponible');
            } else {
                btn.classList.add('no-disponible');
                btn.disabled = true;
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

cargarHoras('dia'); // Carga inicial