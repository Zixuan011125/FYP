const daysContainer = document.querySelector(".days");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");
const todayBtn = document.querySelector(".today");
const month = document.querySelector(".month");

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const renderCalendar = () => {
    date.setDate(1);
    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const lastDayIndex = lastDay.getDay();
    const lastDayDate = lastDay.getDate();
    const prevLastDay = new Date(currentYear, currentMonth, 0);
    const prevLastDayDate = prevLastDay.getDate();
    const nextDays = 7 - lastDayIndex - 1;

    month.innerHTML = `${months[currentMonth]} ${currentYear}`;

    let days = "";

    for (let x = firstDay.getDay(); x > 0; x--) {
        days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
    }

    for (let i = 1; i <= lastDayDate; i++) {
        if (
            i === new Date().getDate() &&
            currentMonth === new Date().getMonth() &&
            currentYear === new Date().getFullYear()
        ) {
            days += `<div class="day today" onclick="handleDateClick(${currentMonth + 1}, ${i}, ${currentYear})">${i}</div>`;
        } else {
            days += `<div class="day" onclick="handleDateClick(${currentMonth + 1}, ${i}, ${currentYear})">${i}</div>`;
        }
    }

    for (let j = 1; j <= nextDays; j++) {
        days += `<div class="day next">${j}</div>`;
    }

    daysContainer.innerHTML = days;
    hideTodayBtn();
};

nextBtn.addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
});

prevBtn.addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar();
});

todayBtn.addEventListener("click", () => {
    currentMonth = date.getMonth();
    currentYear = date.getFullYear();
    renderCalendar();
});

function hideTodayBtn() {
    if (
        currentMonth === new Date().getMonth() &&
        currentYear === new Date().getFullYear()
    ) {
        todayBtn.style.display = "none";
    } else {
        todayBtn.style.display = "flex";
    }
}

// for make sure the booking appoinments is one day forward
function handleDateClick(month, day, year) {
    const clickedDate = new Date(year, month - 1, day); // Month is 0-indexed
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0); // Set current date to the beginning of the day

    // Get the date for tomorrow
    const tomorrowDate = new Date(currentDate);
    tomorrowDate.setDate(tomorrowDate.getDate() + 1);

    // Extract year, month, and day from the clicked date and current date
    const clickedYear = clickedDate.getFullYear();
    const clickedMonth = clickedDate.getMonth();
    const clickedDay = clickedDate.getDate();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
    const currentDay = currentDate.getDate();

    if (clickedYear < currentYear ||
        (clickedYear === currentYear && clickedMonth < currentMonth) ||
        (clickedYear === currentYear && clickedMonth === currentMonth && clickedDay < currentDay)) {
        // Alert for past dates
        alert("The past dates cannot be booking for appointments.");
    } else if (clickedYear === currentYear && clickedMonth === currentMonth && clickedDay === currentDay) {
        // Alert for today
        alert("Please select a date at least one day forward.");
    } else {
        // Redirect to another page passing the clicked date information
        // window.location.href = `timeSlot.php?month=${month}&day=${day}&year=${year}`;
        // Assuming you have variables year, month, and day already defined
        window.location.href = `timeSlot.php?date=${year}-${month}-${day}`;

    }
}

renderCalendar();