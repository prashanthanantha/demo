

//save button
var editPostSaveButton = document.getElementById("edit-post-save-button");


function editPostValidation(){
    var editTitle = document.getElementById("edit-title");
    var editImage = document.getElementById("edit-image");
    var editEmail = document.getElementById("edit-email");
    var editMobile = document.getElementById("edit-mobile");
    var editCombineEmailAndMobile = document.getElementsByClassName("combine_email_and_mobile");
    var editApllicationFee = document.getElementById("edit-application-fee");
    var editownerName = document.getElementById("edit-owner-name");
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
    
    var editImageRegEx = /((.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG))?$/;
    var editImageValue = editImage.value;
    var editImageFiles = editImage.files;
    var editImageFilesLength = editImageFiles.length;
    
    if(!editImageValue.match(editImageRegEx)){
        editImage.classList.add("new_input_error_bg", "image-files");
        editImage.title = "We Accept Only jpg, jpeg, png, svg, gif And JPG Files Onl y";
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

    //email and mobile
    var editEmailRegEx =  /^(([a-z0-9.]+)@([a-z]+)\.([a-z]+))?$/;
    var editMobileRegEx = /^((\d{3})-(\d{3})-(\d{4}))?$/;

    for(var i = 0; i < editCombineEmailAndMobile.length; i++){        
        var editCombineEmailValue = editCombineEmailAndMobile[0].value.trim();
        var editCombineMobileValue = editCombineEmailAndMobile[1].value.trim();
        if((editCombineMobileValue === null || editCombineMobileValue === "") && (editCombineEmailValue === null || editCombineEmailValue === "")){
            editEmail.placeholder = "please enter email id or mobile number";
            editEmail.classList.add("new_input_error_bg");
            editEmail.focus();
            editEmail.onclick = function(){
                editEmail.placeholder = "www.example.com";
                editEmail.classList.remove("new_input_error_bg");
                
            }
            editEmail.onkeypress = function(){
                editEmail.placeholder = "www.example.com";
                editEmail.classList.remove("new_input_error_bg");
                
            }
            editMobile.placeholder = "please enter email id or mobile number";
            editMobile.classList.add("new_input_error_bg");
            editMobile.focus();
            editMobile.onclick = function(){
                editMobile.placeholder = "555-555-1234";
                editMobile.classList.remove("new_input_error_bg");
                
            }
            editMobile.onkeypress = function(){
                editMobile.placeholder = "555-555-1234";
                editMobile.classList.remove("new_input_error_bg");
                
            }            
            return false;
        }
        else if( (!editCombineEmailValue.match(editEmailRegEx)) || (!editCombineMobileValue.match(editMobileRegEx)) ){
            editEmail.value = "";
            editEmail.placeholder = "please enter Correct email address";
            editEmail.classList.add("new_input_error_bg");
            editEmail.focus();
            editEmail.onclick = function(){
                editEmail.placeholder = "www.example.com";
                editEmail.classList.remove("new_input_error_bg");
                
            }
            editEmail.onkeypress = function(){
                editEmail.placeholder = "www.example.com";
                editEmail.classList.remove("new_input_error_bg");
                
            }
            editMobile.value = "";
            editMobile.placeholder = "please enter correct mobile number";
            editMobile.classList.add("new_input_error_bg");
            editMobile.focus();
            editMobile.onclick = function(){
                editMobile.placeholder = "555-555-1234";
                editMobile.classList.remove("new_input_error_bg");
                
            }
            editMobile.onkeypress = function(){
                editMobile.placeholder = "555-555-1234";
                editMobile.classList.remove("new_input_error_bg");
                
            }
            return false;
        }
    }
    //Application Fee and Price Value
    var editApllicationFeeValue = editApllicationFee.value.trim();
    var editApllicationFeeRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
    if(editApllicationFeeValue === null || editApllicationFeeValue === ""){
        editApllicationFee.placeholder = "Please Enter Fee";
        editApllicationFee.classList.add("new_input_error_bg");
        editApllicationFee.focus();
        editApllicationFee.onclick = function(){
            editApllicationFee.placeholder = "200.00";
            editApllicationFee.classList.remove("new_input_error_bg");
            
        }
        editApllicationFee.onkeypress = function(){
            editApllicationFee.placeholder = "200.00";
            editApllicationFee.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    else if(!editApllicationFeeValue.match(editApllicationFeeRegEx)){
        editApllicationFee.value = "";
        editApllicationFee.placeholder = "Please Enter Correct Fee";
        editApllicationFee.classList.add("new_input_error_bg");
        editApllicationFee.focus();
        editApllicationFee.onclick = function(){
            editApllicationFee.placeholder = "200.00";
            editApllicationFee.classList.remove("new_input_error_bg");
            
        }
        editApllicationFee.onkeypress = function(){
            editApllicationFee.placeholder = "200.00";
            editApllicationFee.classList.remove("new_input_error_bg");
            
        }
        return false;
    }

    //Owner name
    var editownerNameValue = editownerName.value.trim();
    var editOwnerRegex = /^([a-zA-Z0-9 \'-\.]+){2}$/;
    if(editownerNameValue === null || editownerNameValue === ""){
        editownerName.placeholder = "Please Enter Owner Name";
        editownerName.classList.add("new_input_error_bg");
        editownerName.focus();
        editownerName.onclick = function(){
            editownerName.placeholder = "Ex: John";
            editownerName.classList.remove("new_input_error_bg");
            
        }
        editownerName.onkeypress = function(){
            editownerName.placeholder = "Ex: John";
            editownerName.classList.remove("new_input_error_bg");
            
        }
        return false;
    }
    else 
    if(!editownerNameValue.match(editOwnerRegex)){
        editownerName.value = "";
        editownerName.placeholder = "Please Enter Owner Name Correctly";
        editownerName.classList.add("new_input_error_bg");
        editownerName.focus();
        editownerName.onclick = function(){
            editownerName.placeholder = "Ex: John";
            editownerName.classList.remove("new_input_error_bg");
            
        }
        editownerName.onkeypress = function(){
            editownerName.placeholder = "Ex: John";
            editownerName.classList.remove("new_input_error_bg");
            
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