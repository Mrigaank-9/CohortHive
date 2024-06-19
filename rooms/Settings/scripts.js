function openSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
}

function goBack() {
        window.location.href = '../index.php';
}


function copyID() {
    const roomId = document.getElementById('roomId').innerText;
    navigator.clipboard.writeText(roomId);
    alert('Room ID copied to clipboard');
}

function copyPass() {
    const roomPass = document.getElementById('roomPass').innerText;
    navigator.clipboard.writeText(roomPass);
    alert('Room password copied to clipboard');
}

function saveChanges(formId) {
    const form = document.getElementById(formId);
    if (form.checkValidity()) {
        alert('Changes saved successfully!');
        // Implement your save logic here
    } else {
        alert('Please fill out all required fields.');
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// For demonstration purposes, to simulate the form save action
document.getElementById('accountForm').addEventListener('submit', (e) => {
    e.preventDefault();
    saveChanges('accountForm');
});

document.getElementById('passwordForm').addEventListener('submit', (e) => {
    e.preventDefault();
    saveChanges('passwordForm');
});

document.getElementById('nameForm').addEventListener('submit', (e) => {
    e.preventDefault();
    saveChanges('nameForm');
});
