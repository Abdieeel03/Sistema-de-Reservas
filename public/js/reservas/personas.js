const contenedor = document.getElementById("botones-container");
const botonMas = document.getElementById("btn-mas");
const fila = document.querySelector(".fila");
botonMas.addEventListener("click", () => {
    // Crear una nueva fila
    const nuevaFila = document.createElement("div");
    nuevaFila.classList.add("fila");

    // Agregar los botones 7 al 12
    for (let i = 7; i <= 12; i++) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "boton-personas";
        btn.textContent = i;
        nuevaFila.appendChild(btn);
    }

    // Agregar la nueva fila al contenedor
    contenedor.appendChild(nuevaFila);

    // Ocultar el botón +
    botonMas.style.display = "none";
    fila.style.gap = "52px";
    nuevaFila.style.gap = "52px";
});