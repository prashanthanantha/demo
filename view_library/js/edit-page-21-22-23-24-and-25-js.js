
//save button
var editPostSaveButton = document.getElementById("edit-post-save-button");


function editPostValidation(){
    var editTitle = document.getElementById("edit-title");
    var editImage = document.getElementById("edit-image");
    var editDirectors = document.getElementById("edit-directors");
    var editproducer = document.getElementById("edit-producer");
    var editMusicBy = document.getElementById("edit-music-by");
    var editTheaterIn = document.getElementById("edit-theater-in");
    var editCastCrew = document.getElementById("edit-cast-crew");
    var editReleaseDate = document.getElementById("edit-release-date");
    var editLocation = document.getElementById("edit-location");
    var editStreet = document.getElementById("edit-street");
    var editZip = document.getElementById("edit-zip");
    var editDescriptionTextArea = document.getElementById("edit-description");
    
    //Post title
    editTitleValue = editTitle.value;
    editTitleValueTrim = editTitleValue.trim();
    var editTitleRegex = /^([a-zA-Z0-9 -\.,!&@#$%()\?+|:"/\[\]'])+$/;
    
    if(editTitleValue.length < 3){
        editTitle.value = "";
        editTitle.placeholder = "please enter more than 3 characters";
        editTitle.classList.add("new_input_error_bg");
        editTitle.focus();
        editTitle.onclick = function(){
            editTitle.placeholder = "Title";    
            editTitle.classList.remove("new_input_error_bg");
            editTitle.value = editTitleValue;
        }
        return false;
    
    }else if(!editTitleValue.match(editTitleRegex)){
        editTitle.value = "";
        editTitle.placeholder = "please do not enter special characters";        
        editTitle.classList.add("new_input_error_bg");
        editTitle.focus();
        editTitle.onclick = function(){
            editTitle.placeholder = "Title";    
            editTitle.classList.remove("new_input_error_bg");
            editTitle.value = editTitleValue;
        }
        editTitle.onkeypress = function(){
            editTitle.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    //image
    
    var editImageRegEx = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;
    var editImageValue = editImage.value;
    var editImageFiles = editImage.files;
    var editImageFilesLength = editImageFiles.length;
    if(editImageValue === null || editImageValue === ""){
        editImage.classList.add("new_input_error_bg", "image-files-three");
        editImage.title = "Please select An Image";
        editImage.focus();
        editImage.onclick = function(){
            editImage.classList.remove("new_input_error_bg", "image-files-three");
        }
        return false;
    }else if(!editImageValue.match(editImageRegEx)){
        editImage.classList.add("new_input_error_bg", "image-files");
        editImage.title = "We Accept Only jpg, jpeg, png, svg, gif And JPG Files Only";
        editImage.focus();
        editImage.onclick = function(){
            editImage.classList.remove("new_input_error_bg", "image-files");
        }
        return false;

    }else if(editImageFilesLength > 3){        
        editImage.classList.add("new_input_error_bg", "image-files-two");
        editImage.title = "Please Upload only three images";
        editImage.focus();
        editImage.onclick = function(){
            editImage.classList.remove("new_input_error_bg", "image-files-two");
        }
        return false;
    }
    else if(editImageFilesLength <= 3){
        for(var i = 0; i < editImageFilesLength; i++){
            var ediImageFileSize = editImageFiles[i].size / 1024 / 1024;
            if(ediImageFileSize > 1){
                editImage.classList.add("new_input_error_bg", "image-files-one");
                editImage.title = "Your File Should Be less Than 1 MB";
                editImage.focus();
                editImage.onclick = function(){
                    editImage.classList.remove("new_input_error_bg", "image-files-one");
                }
                return false;
            }
        }
    }
    //directors
    var editDirectorsValue = editDirectors.value.trim();
    var editDirectorsRegEx = /^([a-zA-Z \'-\.]+){2}$/;

    if(editDirectorsValue === null || editDirectorsValue === ""){
        editDirectors.placeholder = "please enter Director's Name";
        editDirectors.classList.add("new_input_error_bg");
        editDirectors.focus();
        editDirectors.onclick = function(){
            editDirectors.placeholder = "Movie Director's Name";
            editDirectors.classList.remove("new_input_error_bg");
            
        }
        editDirectors.onkeypress = function(){
            editDirectors.placeholder = "Movie Director's Name";
            editDirectors.classList.remove("new_input_error_bg");
            
        }
        return false;
    }else if(!editDirectorsValue.match(editDirectorsRegEx)){
        editDirectors.value = "";
        editDirectors.placeholder = "please enter Director's Name Correctly";
        editDirectors.classList.add("new_input_error_bg");
        editDirectors.focus();
        editDirectors.onclick = function(){
            editDirectors.placeholder = "Movie Director's Name";
            editDirectors.classList.remove("new_input_error_bg");
            
        }
        editDirectors.onkeypress = function(){
            editDirectors.placeholder = "Movie Director's Name";
            editDirectors.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    //producer
    var editproducerValue = editproducer.value.trim();
    if(editproducerValue === null || editproducerValue === ""){
        editproducer.placeholder = "please enter Producer's Name Correctly";
        editproducer.classList.add("new_input_error_bg");
        editproducer.focus();
        editproducer.onclick = function(){
            editproducer.placeholder = "Movie Producer's Name";
            editproducer.classList.remove("new_input_error_bg");
            
        }
        editproducer.onkeypress = function(){
            editproducer.placeholder = "Movie Producer's Name";
            editproducer.classList.remove("new_input_error_bg");
            
        }
        return false;
    }else if(!editproducerValue.match(editDirectorsRegEx)){
        editproducer.value = "";
        editproducer.placeholder = "please enter Producer's Name Correctly";
        editproducer.classList.add("new_input_error_bg");
        editproducer.focus();
        editproducer.onclick = function(){
            editproducer.placeholder = "Movie Producer's Name";
            editproducer.classList.remove("new_input_error_bg");
            
        }
        editproducer.onkeypress = function(){
            editproducer.placeholder = "Movie Producer's Name";
            editproducer.classList.remove("new_input_error_bg");
            
        }
        return false;
    }   
    //Music By
    var editMusicByValue = editMusicBy.value.trim();
    if(editMusicByValue === null || editMusicByValue === ""){
        editMusicBy.placeholder = "please enter Music Director's Name Correctly";
        editMusicBy.classList.add("new_input_error_bg");
        editMusicBy.focus();
        editMusicBy.onclick = function(){
            editMusicBy.placeholder = "Movie Music Director's Name";
            editMusicBy.classList.remove("new_input_error_bg");
            
        }
        editMusicBy.onkeypress = function(){
            editMusicBy.placeholder = "Movie Music Director's Name";
            editMusicBy.classList.remove("new_input_error_bg");
            
        }
        return false;
    }else if(!editMusicByValue.match(editDirectorsRegEx)){
        editMusicBy.value = "";
        editMusicBy.placeholder = "please enter Music Director's Name Correctly";
        editMusicBy.classList.add("new_input_error_bg");
        editMusicBy.focus();
        editMusicBy.onclick = function(){
            editMusicBy.placeholder = "Movie Music Director's Name";
            editMusicBy.classList.remove("new_input_error_bg");
            
        }
        editMusicBy.onkeypress = function(){
            editMusicBy.placeholder = "Movie Music Director's Name";
            editMusicBy.classList.remove("new_input_error_bg");
            
        }
        return false;
    }   

    //Theaters in 
    var editTheaterInValue = editTheaterIn.value.trim();
    var editTheaterInRegEx = /^([a-zA-Z0-9 \'-\.]+){2}$/;
    if(editTheaterInValue === null || editTheaterInValue === ""){
        editTheaterIn.placeholder = "please enter Theater's List Correctly";
        editTheaterIn.classList.add("new_input_error_bg");
        editTheaterIn.focus();
        editTheaterIn.onclick = function(){
            editTheaterIn.placeholder = "Movie Theater's List";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        editTheaterIn.onkeypress = function(){
            editTheaterIn.placeholder = "Movie Theater's List";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        return false;
    }else if(!editTheaterInValue.match(editTheaterInRegEx)){
        editTheaterIn.value = "";
        editTheaterIn.placeholder = "please enter Theater's List Correctly";
        editTheaterIn.classList.add("new_input_error_bg");
        editTheaterIn.focus();
        editTheaterIn.onclick = function(){
            editTheaterIn.placeholder = "Movie Theater's List";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        editTheaterIn.onkeypress = function(){
            editTheaterIn.placeholder = "Movie Theater's List";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    //Cast And Crew
    var editCastCrewValue = editCastCrew.value.trim();
    if(editCastCrewValue === null || editCastCrewValue === ""){
        editTheaterIn.placeholder = "please enter Cast And Crew Correctly";
        editTheaterIn.classList.add("new_input_error_bg");
        editTheaterIn.focus();
        editTheaterIn.onclick = function(){
            editTheaterIn.placeholder = "Movie Cast And Crew";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        editTheaterIn.onkeypress = function(){
            editTheaterIn.placeholder = "Movie Cast And Crew";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        return false;
    }else if(!editCastCrewValue.match(editDirectorsRegEx)){
        editTheaterIn.value = "";
        editTheaterIn.placeholder = "please enter Cast And Crew Correctly";
        editTheaterIn.classList.add("new_input_error_bg");
        editTheaterIn.focus();
        editTheaterIn.onclick = function(){
            editTheaterIn.placeholder = "Movie Cast And Crew";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        editTheaterIn.onkeypress = function(){
            editTheaterIn.placeholder = "Movie Cast And Crew";
            editTheaterIn.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    //Release Date

    var editReleaseDateValue = editReleaseDate.value;
    var editReleaseDateErrorMessage = document.getElementById("time_error_box_msg_bg");    
    if(editReleaseDateValue === null || editReleaseDateValue === ""){
        editReleaseDate.classList.add("error_msg_box");
        editReleaseDateErrorMessage.textContent = "Please Select Date"
        editReleaseDate.focus();
        editReleaseDate.onclick = function(){                                  
            editReleaseDate.classList.remove("error_msg_box");        
            editReleaseDateErrorMessage.textContent = "";
        }
        return false;
    }
    //location 
    var editLocationRegExMatches = /([_+!~@$%\^&*=()?\/"':;<>|])/; 
    var editLocationRegExNotMatches = /([a-zA-Z0-9-\. ,]+)?/;
    var editLocationValue = editLocation.value.trim();
    if(editLocationValue.match(editLocationRegExMatches) || !editLocationValue.match(editLocationRegExNotMatches)){
        editLocation.value = "";
        editLocation.placeholder = "please enter correct location";
        editLocation.classList.add("new_input_error_bg");
        editLocation.focus();
        editLocation.onclick = function(){
            editLocation.placeholder = "Beside Gateway Arch";
            editLocation.classList.remove("new_input_error_bg");
            
        }
        editLocation.onkeypress = function(){
            editLocation.placeholder = "Beside Gateway Arch";
            editLocation.classList.remove("new_input_error_bg");
            
        }
        return false;
    }

    //street
    var editStreetValue = editStreet.value.trim();
    if(editStreetValue.match(editLocationRegExMatches)  || !editStreetValue.match(editLocationRegExNotMatches)){
        editStreet.value = "";
        editStreet.placeholder = "please enter correct street ";
        editStreet.classList.add("new_input_error_bg");
        editStreet.focus();
        editStreet.onclick = function(){
            editStreet.placeholder = "155 15th street";
            editStreet.classList.remove("new_input_error_bg");
            
        }
        editStreet.onkeypress = function(){
            editStreet.placeholder = "155 15th street";
            editStreet.classList.remove("new_input_error_bg");
            
        }
        return false;
    }

    //Zip Code
    var editZipRegEx = /(^(631)+\d{2}$)/;
    var editZipValue = editZip.value.trim();
    if(!editZipValue.match(editZipRegEx)){
        editZip.value = "";
        editZip.placeholder = "please enter correct Zip Code";
        editZip.classList.add("new_input_error_bg");
        editZip.focus();
        editZip.onclick = function(){
            editZip.placeholder = "63102";
            editZip.classList.remove("new_input_error_bg");
            
        }
        editZip.onkeypress = function(){
            editZip.placeholder = "63102";
            editZip.classList.remove("new_input_error_bg");
            
        }
        return false;
    }

    //Description    
    var editDescriptionTextAreaRegExNotMatches = /^([a-zA-Z0-9!@#$%&*()\-\+\s\.,"'\?/|><:]+)$/;
    var editDescriptionTextAreavalue = editDescriptionTextArea.value.trim();
    if(editDescriptionTextAreavalue.length < 3){
        editDescriptionTextArea.value = "";
        editDescriptionTextArea.placeholder = "please enter more than 3 Characters";
        editDescriptionTextArea.classList.add("new_input_error_bg");
        editDescriptionTextArea.onclick = function(){
            editDescriptionTextArea.placeholder = "Describe About Place";
            editDescriptionTextArea.classList.remove("new_input_error_bg");
        }
        return false;
    }else if(!editDescriptionTextAreavalue.match(editDescriptionTextAreaRegExNotMatches)){
        editDescriptionTextArea.value = "";
        editDescriptionTextArea.placeholder = "Special Characters are not allowed";
        editDescriptionTextArea.classList.add("new_input_error_bg");
        editDescriptionTextArea.onclick = function(){
            editDescriptionTextArea.placeholder = "Describe About Place";
            editDescriptionTextArea.classList.remove("new_input_error_bg");
        }
        return false;
    }
    
    
    

    

    

}
