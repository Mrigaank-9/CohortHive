let addAnnouncement= document.querySelector(".addAnnouncement");
let seeAnnouncements= document.querySelector(".seeAnnouncements");
let createAnnouncement= document.querySelector(".createAnnouncement");
let viewAnnouncement= document.querySelector(".viewAnnouncement");
const container= document.querySelector(".container");

const showAnnouncements= ()=> {
    window.scroll({ top: 80, left: 0, behavior: 'smooth' });
    console.log("Inside Create form!");
    createAnnouncement.classList.remove("hide");
    container.classList.add("blur");
    container.style.display = "block";
};

function copyID() {
    var textToCopy = document.getElementById("roomId").innerText;
    var cleanedText = textToCopy.replace('ID: ', '');
    var tempTextarea = document.createElement('textarea');
    tempTextarea.value = cleanedText;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, 99999);
    document.execCommand('copy');
    document.body.removeChild(tempTextarea);
};
function copyPass() {
    var textToCopy = document.getElementById("roomPass").innerText;
    var cleanedText = textToCopy.replace('Password: ', '');
    var tempTextarea = document.createElement('textarea');
    tempTextarea.value = cleanedText;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, 99999);
    document.execCommand('copy');
    document.body.removeChild(tempTextarea);
};
const showExistingAnnouncements= ()=>{
    window.scroll({ top: 80, left: 0, behavior: 'smooth' });
    console.log("Inside Join form!");
    viewAnnouncement.classList.remove("hide");
    container.classList.add("blur");
    container.style.display = "block";
};
addAnnouncement.addEventListener("click", ()=>{
    console.log("Add announcements button was clicked");
    showAnnouncements();

});
seeAnnouncements.addEventListener("click", ()=>{
    console.log("Create a room button was clicked");
    showExistingAnnouncements();
});

document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.target.closest('.form').classList.add('hide');
        container.classList.remove("blur");
        enableHorizontalScroll();
    });
 });