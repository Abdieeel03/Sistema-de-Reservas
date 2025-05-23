const btnSalaPrincipal = document.getElementById("btn-sala-principal");
const btnSalaExterior = document.getElementById("btn-sala-exterior");
const contendorMesas = document.getElementById("contenedor-mesas");
const btnNav = document.getElementById("btn-mesa");

const mesasPrincipal = [
    { nombre: "Mesa 01", disponible: true },
    { nombre: "Mesa 02", disponible: false },
    { nombre: "Mesa 03", disponible: false },
    { nombre: "Mesa 04", disponible: true },
    { nombre: "Mesa 05", disponible: true },
    { nombre: "Mesa 06", disponible: true }
];

const mesasExterior = [
    { nombre: "Mesa 07", disponible: true },
    { nombre: "Mesa 08", disponible: true },
    { nombre: "Mesa 09", disponible: false }
];

btnNav.addEventListener('click', () => {
    btnSalaExterior.classList.remove('activo');
    btnSalaPrincipal.classList.add('activo');
    renderizarMesas(mesasPrincipal);
});

function renderizarMesas(mesas) {
    contendorMesas.innerHTML = '';
    mesas.forEach(mesa => {
        const btn = document.createElement('button');
        btn.className = `btn-mesa ${mesa.disponible ? 'disponible' : 'no-disponible'}`;
        btn.textContent = mesa.nombre;
        contendorMesas.appendChild(btn);
    });
}

btnSalaPrincipal.addEventListener('click', () => {
    btnSalaExterior.classList.remove('activo');
    btnSalaPrincipal.classList.add('activo');
    renderizarMesas(mesasPrincipal);
});

btnSalaExterior.addEventListener('click', () => {
    btnSalaExterior.classList.add('activo');
    btnSalaPrincipal.classList.remove('activo');
    renderizarMesas(mesasExterior);
});

// Inicializar con la sala principal
btnSalaPrincipal.classList.add('activo');
renderizarMesas(mesasPrincipal);