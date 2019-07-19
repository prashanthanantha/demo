function openTabs(elm, btn){
    var tabContent = document.getElementsByClassName("tabs_content");
    var button = document.getElementsByClassName("my_account_tabs");
    for(var i = 0; i <  tabContent.length;i++){
        tabContent[i].style.display = "none";
    }
    for(var i = 0; i < button.length;i++){
        button[i].classList.remove("active");
    }
    document.getElementById(elm).style.display = "block";
    btn.classList.add("active");
}
document.getElementById("defaultTab").click();



//validation
function editProfile(){
    var userFirstName = document.getElementById("user-first-name");
    var userLastName = document.getElementById("user-last-name");
    var userDOB = document.getElementById("user-dob");
    var userMobileNumber = document.getElementById("user-mobile-number");
    var userGender = document.getElementById("user-gender");
    var userGenderValue = userGender.options[userGender.selectedIndex].value;
    var userCityState = document.getElementById("user-city-state");
    var userZipCode = document.getElementById("user-zip-code");
    var userCountry = document.getElementById("user-country");
    var userProfilePic = document.getElementById("user-profile-pic");
    var userRegEx = /^([a-zA-Z \.\'-]+){2}$/;

    var userFirstNameValue = userFirstName.value.trim();
    if(!userFirstNameValue.match(userRegEx)){
        commonValidateFunction(userFirstName, "please Enter First Name", "new_input_error_bg", "First Name", "text", "text") ;      
        return false;
    }
    var userLastNameValue = userLastName.value.trim();
    if(!userLastNameValue.match(userRegEx)){
        commonValidateFunction(userLastName, "please Enter Last Name", "new_input_error_bg", "Last Name", "text", "text");     
        return false;
    }
    var userDOBValue = userDOB.value;
    if(userDOBValue === null || userDOBValue === ""){
        commonValidateFunction(userDOB, "please Enter Date Of birth", "new_input_error_bg", "Date Of Birth", "text", "date");     
        return false;
    }
    var userMobileNumbervalue = userMobileNumber.value.trim();
    var userMobileRegex = /^((\d{3})-(\d{3})-(\d{4}))?$/;
    
    if(!userMobileNumbervalue.match(userMobileRegex)){
        commonValidateFunction(userMobileNumber, "please Enter Mobile Number Correctly", "new_input_error_bg", "Mobile Number", "text", "text");     
        return false;
    }   
    if(userGenderValue === "0"){
        userGender.options[0].text = "please Select Gender";
        userGender.style.color = "#e3095a";
        userGender.style.fontWeight = 700;
        userGender.focus();
        userGender.onclick = function(){
            userGender.options[0].text = "Select Gender";
            userGender.style.color = "#555";
            userGender.style.fontWeight = 400;
        }
        return false;
    }
    var userCityStateValue = userCityState.value.trim();
    if(userCityStateValue !== "St Louis, MO"){
        commonValidateFunction(userCityState, "please Enter City And State", "new_input_error_bg", "Ex : St Louis, MO", "text", "text");     
        return false;
    }
    var userCountryValue = userCountry.value.trim();
    if(userCountryValue !== "USA"){
        commonValidateFunction(userCountry, "please Enter Country", "new_input_error_bg", "Ex : USA", "text", "text");     
        return false;
    }
    var userZipCodeValue = userZipCode.value.trim();
    var userZipCodeRegex =  /(^(631)+\d{2}$)/;
    if(!userZipCodeValue.match(userZipCodeRegex)){
        commonValidateFunction(userZipCode, "please Enter Zip Code Correctly", "new_input_error_bg", "Ex : 63110", "text", "text");     
        return false;
    }
    var userProfilePicValue = userProfilePic.value;
    var userProfilePicFiles = userProfilePic.files;
    var userProfilePicRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;

    if(userProfilePicValue === null || userProfilePicValue === ""){

    }
    else {        
        var userProfilePicSize = userProfilePicFiles[0].size / 1024 / 1024;
        if(!userProfilePicValue.match(userProfilePicRegex)){
            commonValidateFunction(userProfilePic, "We Accept jpg, jpeg, svg, bmp, gif, png and JPG Files", "new_input_error_bg", "", "text", "file");     
            return false;
        }
        else
        if(userProfilePicSize > 1){
            commonValidateFunction(userProfilePic, "Please Upload Less Than 1 MB File", "new_input_error_bg", "", "text", "file");     
            return false;
        }
    }
    


}

function commonValidateFunction(fieldName, fieldPlaceHolder, fieldClassName, fieldClickPlaceHolder, fieldType, fieldClickType){
    fieldName.type = fieldType;
    fieldName.value = "";
    fieldName.placeholder = fieldPlaceHolder;
    fieldName.classList.add(fieldClassName)
    fieldName.focus();
    fieldName.onclick = function(){
        fieldName.type = fieldClickType;
        fieldName.placeholder = fieldClickPlaceHolder;
        fieldName.classList.remove(fieldClassName);
    }
    fieldName.onkeypress = function(){
        fieldName.type = fieldClickType;
        fieldName.placeholder = fieldClickPlaceHolder;
        fieldName.classList.remove(fieldClassName);
    }

}


 


//fancybox image Viewer
$('[data-fancybox="images"]').fancybox({
    buttons : [ 
    'slideShow',
    'share',
    'zoom',
    'fullScreen',
    'close'
    ],
    thumbs : {
    autoStart : true
    }
});


//remove image
var chooseFileUser = document.getElementById("user-profile-pic");
var userImagePreviewing = document.getElementById("user-image-previewing");
var userTextPreviewing = document.getElementById("user-text-previewing");
var removeImagePreview = document.getElementsByClassName("preview_image_responsive_button");
for(i = 0; i < removeImagePreview.length;i++){
    removeImagePreview[i].addEventListener("click", removingImageSrc);
}

function removingImageSrc(){    
    userImagePreviewing.src = "";
    chooseFileUser.value = "";
    commonFunctionPreview(userImagePreviewing, userTextPreviewing);                
}

chooseFileUser.addEventListener("change", inputFileNotEmpty);

function inputFileNotEmpty(){
    var chooseFileUserFiles = chooseFileUser.files[0];
    var chooseFileUserFilesSize = chooseFileUserFiles.size / 1024 / 1024;
    var chooseFileUserValue = chooseFileUser.value;
    var chooseFileValeRegexa = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;
    if( chooseFileUserFilesSize < 1 && (chooseFileUserValue).match(chooseFileValeRegexa) ){
        
        console.log(chooseFileUserFiles.type);
        var readerFile = new FileReader();
        readerFile.addEventListener("load", function(){
            userImagePreviewing.src = readerFile.result;
        }, false);
        if(chooseFileUserFiles){
            readerFile.readAsDataURL(chooseFileUserFiles);
        }
    }  
    else          
    if(chooseFileUserFilesSize > 1){      
        commonValidateFunction(chooseFileUser, "Please Upload Less Than 1 MB File", "new_input_error_bg", "", "text", "file");             
          
        return false;
    }
    else  
    if(!(chooseFileUserValue).match(chooseFileValeRegexa)){     
          
        commonValidateFunction(chooseFileUser, "We Accept jpg, jpeg, svg, bmp, gif, png and JPG Files", "new_input_error_bg", "", "text", "file");               
        return false;
    }


    if(!chooseFileUser.value == ""){        
        commonFunctionPreview(userTextPreviewing, userImagePreviewing);     
    }
}
   
if(!userImagePreviewing.getAttribute('src') == ""){
    commonFunctionPreview(userTextPreviewing, userImagePreviewing);        
}
else 
{
    commonFunctionPreview(userImagePreviewing, userTextPreviewing);    
}


function commonFunctionPreview(imgg, textt){
    
    var userImagePreviewWrapper = imgg.parentNode;
    var userImagePreviewBg = userImagePreviewWrapper.parentNode;
    userImagePreviewBg.style.display = "none";
    var textWrapper = textt.parentNode;
    var textWrapperBg = textWrapper.parentNode;
    textWrapperBg.style.display = "block";

}

var userFirstNameLetter = document.getElementById("user-first-name");
var userLastNameLetter = document.getElementById("user-last-name");


function commonFirstletterFunction(ltt){
    var letter = ltt.value;
    return letter.charAt(0);
}
var firstNameLetter = commonFirstletterFunction(userFirstNameLetter);
var lastNameLetter = commonFirstletterFunction(userLastNameLetter);
var childLetters = document.getElementById("text-replacement");
childLetters.textContent = firstNameLetter + lastNameLetter;