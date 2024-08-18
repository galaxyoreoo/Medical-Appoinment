// Buat variabel global untuk menyimpan pilihan pengguna
var selectedOptions = [];

function openHospitalBranchPopup() {
    document.getElementById('hospitalBranchPopup').style.display = 'block';
}

function closeHospitalBranchPopup() {
    document.getElementById('hospitalBranchPopup').style.display = 'none';
}

function selectHospital(hospital) {
    selectedOptions.push({ type: 'Hospital Branch', value: hospital });
    updateSelectedOptions(); // Perbarui daftar pilihan yang ditampilkan
    closeHospitalBranchPopup(); // Sembunyikan popup setelah memilih
}

function openSpecializationPopup() {
    document.getElementById('specializationPopup').style.display = 'block';
}

function closeSpecializationPopup() {
    document.getElementById('specializationPopup').style.display = 'none';
}

function selectSpecialization(specialization) {
    selectedOptions.push({ type: 'Specialization', value: specialization });
    updateSelectedOptions();
    closeSpecializationPopup(); // Sembunyikan popup setelah memilih
}

function openDateCalendar() {
    document.getElementById('dateCalendar').style.display = 'block';
}

function closeDateCalendar() {
    document.getElementById('dateCalendar').style.display = 'none';
}

function selectDate() {
    var selectedDate = document.getElementById('selectedDate').value;
    selectedOptions.push({ type: 'Date', value: selectedDate });
    updateSelectedOptions();
    closeDateCalendar(); // Sembunyikan popup setelah memilih
}

function confirmAppointment() {
    if (selectedOptions.length === 0) {
        alert('Please select options before making an appointment.');
        return;
    }
    document.getElementById('appointmentConfirmationPopup').style.display = 'block';
}

function closeAppointmentConfirmationPopup() {
    document.getElementById('appointmentConfirmationPopup').style.display = 'none';
}

function makeAppointment() {
    // Implement your appointment-making logic here
    alert('Appointment made successfully!');
    // Reset selected options
    selectedOptions = [];
    updateSelectedOptions();
    // Close confirmation popup
    closeAppointmentConfirmationPopup();
}

function updateSelectedOptions() {
    var selectedOptionsList = document.getElementById('selectedOptionsList');
    selectedOptionsList.innerHTML = ''; // Kosongkan daftar pilihan sebelum menambahkan yang baru

    // Tambahkan setiap pilihan ke dalam daftar
    selectedOptions.forEach(function(option) {
        var li = document.createElement('li');
        li.textContent = option.type + ': ' + option.value;
        selectedOptionsList.appendChild(li);
    });
}
