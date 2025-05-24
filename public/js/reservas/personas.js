const contenedor = document.getElementById("botones-container");
const botonMas = document.getElementById("btn-mas");
const fila = document.querySelector(".fila");

let botonesExtrasVisibles = false;
let nuevaFila = null; // se usará para guardar la fila con botones 7-12

botonMas.addEventListener("click", () => {
    if (!botonesExtrasVisibles) {
        // Si aún no se ha creado, la creamos
        if (!nuevaFila) {
            nuevaFila = document.createElement("div");
            nuevaFila.classList.add("fila");

            for (let i = 7; i <= 12; i++) {
                const btn = document.createElement("button");
                btn.type = "button";
                btn.className = "boton-personas";
                btn.textContent = i;
                nuevaFila.appendChild(btn);
            }

            nuevaFila.style.gap = "52px";
            contenedor.appendChild(nuevaFila);
        } else {
            nuevaFila.style.display = "flex"; // mostrar si ya existía pero estaba oculta
        }

        botonMas.textContent = "−";
    } else {
        nuevaFila.style.display = "none"; // ocultar
        botonMas.textContent = "+";
    }

    fila.style.gap = "52px";
    botonesExtrasVisibles = !botonesExtrasVisibles;
});