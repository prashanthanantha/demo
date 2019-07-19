var editDescription = document.getElementById("edit-description");
editDescription.addEventListener("keyup", function(){
    
    editDescription.style.height = 10 + "px";
   editDescription.style.height = (25 + editDescription.scrollHeight) + "px";
    
     
});
editDescription.addEventListener("keydown", function(){
    descriptionCounter();
});
var editDescriptionCount = document.getElementById("edit-description");
var textAreaCounter = document.getElementById("text_area_Counter_bg");
var textAreaMaxLength = 500;
function descriptionCounter(){   
   
      var numberTrim = editDescriptionCount.value;
      var numberLength =   numberTrim.length;
      textAreaCounter.textContent =  textAreaMaxLength - numberLength ;
      if(numberLength <= 480){
        textAreaCounter.style.color = "black";
      }
      else if(numberLength > 480){
        textAreaCounter.style.color = "#e3095a";
      }
}
descriptionCounter();
