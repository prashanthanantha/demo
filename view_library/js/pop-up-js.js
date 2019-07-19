//pop up
var popUpButton = document.getElementsByClassName("pop_up_button");
var popUpMana = document.querySelector("#pop_up_mana");
var popUpCloseButton = document.getElementsByClassName("pop_up_close_button");
for(var i = 0; i < popUpButton.length; i++){
    popUpButton[i].addEventListener("click", function(){
        popUpMana.style.display === "block" ? popUpMana.style.display = "none" : popUpMana.style.display = "block";
    });    
}
for(var i = 0; i < popUpCloseButton.length;i++){
    popUpCloseButton[i].addEventListener("click", function(){
        popUpMana.style.display === "block" ? popUpMana.style.display = "none" : popUpMana.style.display = "block";
    });   
}
function popUpOutter(event){   
    if(event.target === popUpMana){
        popUpMana.style.display = "none"
    }
}
window.onclick = popUpOutter;