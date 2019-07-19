
var openDayCheckBoxs = document.getElementsByClassName("edit_post_page_checkbox");
var displayElements = document.getElementsByClassName("edit_post_page_form_open_hours_label_bg");
for(var i = 0; i < openDayCheckBoxs.length;i++){
    if(openDayCheckBoxs[i].checked){
       // debugger;
        //var extra = document.getElementsByClassName("edit_post_page_form_open_hours_input_bg");
        var i;
        for( i += 0; i < displayElements.length; i++){
            //debugger;
            displayElements[i].classList.toggle("edit_post_date_list_toggle_class");
            var openHoursExtraClass = document.getElementsByClassName("edit_post_page_form_open_hours_input_bg");
            if(displayElements[i].classList.contains("edit_post_date_list_toggle_class")){
                var x = displayElements[i].getElementsByClassName("edit_post_page_form_open_hours_input_bg");
                for(var j = 0; j < x.length; j++){
                    x[j].classList.toggle("validating_time");
                }
                
            }
            break;
        }
    }
}
for(var i = 0; i < openDayCheckBoxs.length; i++){
    openDayCheckBoxs[i].addEventListener('click', checkboxes);
}
function checkboxes(){       
    var ids = this.id;    
    if(ids === "edit-monday"){
        timeList(0);
    }
    else if(ids === "edit-tuesday"){
        timeList(1);
    }
    else if(ids === "edit-wednesday"){
        timeList(2);
    }
    else if(ids === "edit-thursday"){
        timeList(3);
    }
    else if(ids === "edit-friday"){
        timeList(4);
    }
    else if(ids === "edit-saturday"){
        timeList(5);
    }
    else if(ids === "edit-sunday"){
        timeList(6);
    }

}
function timeList(num){
    displayElements[num].classList.toggle("edit_post_date_list_toggle_class");
    if(displayElements[num].classList.contains("edit_post_date_list_toggle_class")){
        var x = displayElements[num].getElementsByClassName("edit_post_page_form_open_hours_input_bg");
        for(var j = 0; j < x.length; j++){
            x[j].classList.add("validating_time");
        }
        
    }
    else if(!displayElements[num].classList.contains("edit_post_date_list_toggle_class")){
        var x = displayElements[num].getElementsByClassName("edit_post_page_form_open_hours_input_bg");
        for(var j = 0; j < x.length; j++){
            x[j].classList.remove("validating_time");
        }
    }
}   

//edit form validations
