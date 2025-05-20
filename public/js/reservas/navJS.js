const pasos = document.querySelectorAll('.pasos-reserva .paso');
const secciones = document.querySelectorAll('.seccion-reserva');

pasos.forEach(paso => {
    paso.addEventListener('click', () => {
        // Cambiar clase activa en pasos
        pasos.forEach(p => p.classList.remove('activo'));
        paso.classList.add('activo');

        // Mostrar la sección correspondiente
        const pasoId = paso.dataset.step; // p.ej. "1", "2", etc.

        secciones.forEach(sec => {
            sec.classList.add('hidden');
            sec.classList.remove('activo');
        });

        let idSeccion = "";
        switch (pasoId) {
            case "1": idSeccion = "seccion-datos"; break;
            case "2": idSeccion = "seccion-personas"; break;
            case "3": idSeccion = "seccion-fecha"; break;
            case "4": idSeccion = "seccion-hora"; break;
            case "5": idSeccion = "seccion-mesa"; break;
            default: idSeccion = "seccion-datos";
        }

        const actual = document.getElementById(idSeccion);
        if (actual) {
            actual.classList.remove('hidden');
            actual.classList.add('activo');
        }
    });
});