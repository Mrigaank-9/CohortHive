let create= document.querySelector(".create");
let join= document.querySelector(".join");
let createForm= document.querySelector(".createMsg");
let joinForm= document.querySelector(".joinMsg");
let startSec= document.querySelector(".startSec");

const showCreateForm= ()=> {
    console.log("Inside Create form!");
    createForm.classList.remove("hide");
    startSec.classList.add("blur");
};

const showJoinForm= ()=> {
    console.log("Inside Join form!");
    joinForm.classList.remove("hide");
    startSec.classList.add("blur");
};
create.addEventListener("click", ()=>{
    console.log("Create a room button was clicked")
    showCreateForm();
});

join.addEventListener("click", ()=>{
    console.log("Join a room button was clicked")
    showJoinForm();
});

