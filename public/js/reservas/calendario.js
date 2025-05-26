const calendarDates = document.getElementById("calendarDates");
const calendarDays = document.getElementById("calendarDays");
const monthYear = document.getElementById("monthYear");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");

let date = new Date();

const weekDays = ["Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"];
const fechasNoDisponibles = ["2025-05-24", "2025-05-25", "2025-05-26", "2025-06-27"];

function renderCalendar() {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDate = new Date(year, month + 1, 0).getDate();
    const startDay = (firstDay.getDay() + 6) % 7; // Lunes = 0

    // Mostrar mes y año
    monthYear.textContent = date.toLocaleString("es-ES", { month: "long", year: "numeric" });

    // Días de la semana
    calendarDays.innerHTML = "";
    weekDays.forEach(day => {
        const div = document.createElement("div");
        div.textContent = day;
        calendarDays.appendChild(div);
    });

    // Fechas del mes
    calendarDates.innerHTML = "";

    for (let i = 0; i < startDay; i++) {
        const div = document.createElement("div");
        div.classList.add("inactive");
        div.style.width = "calc(100% / 7)";
        div.style.aspectRatio = "1 / 1";
        calendarDates.appendChild(div);
    }

    for (let i = 1; i <= lastDate; i++) {
        const button = document.createElement("button");
        button.textContent = i;

        const fechaDelDia = new Date(year, month, i);
        const fechaISO = fechaDelDia.toISOString().split("T")[0];

        const fechaActual = new Date();
        const fechaHoy = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), fechaActual.getDate());

        const esPasado = fechaDelDia < fechaHoy;
        const esNoDisponible = fechasNoDisponibles.includes(fechaISO);

        if (esPasado || esNoDisponible) {
            button.disabled = true;
            button.style.backgroundColor = "var(--color-error)";
            button.style.cursor = "not-allowed";
            button.style.opacity = "0.6";
        } else {
            button.addEventListener("click", () => {
                alert(`Seleccionaste el ${i} de ${date.toLocaleString("es-ES", { month: "long" })} de ${year}`);
            });
        }

        calendarDates.appendChild(button);
    }
}

prevBtn.addEventListener("click", () => {
    const today = new Date();
    if (
        date.getFullYear() === today.getFullYear() &&
        date.getMonth() === today.getMonth()
    ) return;

    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});

nextBtn.addEventListener("click", () => {
    if (date.getFullYear() === 2025 && date.getMonth() === 11) return;
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});

renderCalendar();
