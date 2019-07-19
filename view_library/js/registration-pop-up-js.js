//pop up

function modals(modalId){    
    var allModal = document.getElementById(modalId);
    var modalCloseButton = document.getElementsByClassName("pop_up_close_button1");
    allModal.style.display === "block" ? allModal.style.display = "none" : allModal.style.display = "block";
    for(var i = 0; i < modalCloseButton.length;i++){
        modalCloseButton[i].addEventListener("click", function(){
            allModal.style.display === "block" ? allModal.style.display = "none" : allModal.style.display = "block";
        });   
    }
    
}
