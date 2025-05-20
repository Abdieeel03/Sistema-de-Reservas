const btnSalaPrincipal = document.getElementById("btn-sala-principal");
const btnSalaExterior = document.getElementById("btn-sala-exterior");
const contendorMesas = document.getElementById("contenedor-mesas");

const mesasPrincipal = [
    {nombre: "Mesa 01", disponible: true },
    {nombre: "Mesa 02", disponible: false },
    {nombre: "Mesa 03", disponible: false },
    {nombre: "Mesa 04", disponible: true },
    {nombre: "Mesa 05", disponible: true },
    {nombre: "Mesa 06", disponible: true }
];

const mesasExterior = [
    {nombre: "Mesa 07", disponible: true },
    {nombre: "Mesa 08", disponible: true },
    {nombre: "Mesa 09", disponible: false }
];

function renderizarMesas(mesas){
    contendorMesas.innerHTML = '';
    mesas.forEach(mesa => {
        const btn = document.createElement('button');
        btn.className = `btn-mesa ${mesa.disponible ? 'disponible' : 'no-disponible'}`;
        btn.textContent = mesa.nombre;
        contendorMesas.appendChild(btn);
    });
}

btnSalaPrincipal.addEventListener('click', () => {
    btnSalaPrincipal.classList.add('activo');
    btnSalaPrincipal.classList.remove('no-active');
    btnSalaExterior.classList.remove('activo');
    btnSalaExterior.classList.add('no-active');
    renderizarMesas(mesasPrincipal);
});

btnSalaExterior.addEventListener('click', () => {
    btnSalaExterior.classList.add('activo');
    btnSalaExterior.classList.remove('no-active');
    btnSalaPrincipal.classList.remove('activo');
    btnSalaPrincipal.classList.add('no-active');
    renderizarMesas(mesasExterior);
});

// Inicializar con la sala principal
btnSalaPrincipal.classList.add('activo');
renderizarMesas(mesasPrincipal);