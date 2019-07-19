/*adding dashes for mobile number https://medium.com/@asimmittal/building-a-phone-input-field-in-javascript-from-scratch-a85bb2a3b3d3*/

/*******************************************************
  * create a filter that will be used to determine
  * which keystrokes are allowed in the input field
  * and which are not. Since we're working exclusively
  * with phone numbers, we'll need the following:
  * -- digits 0 to 9 from the numeric keys
  * -- digits 0 to 9 from the num pad keys
  * -- arrow keys (left/right)
  * -- backspace / delete for correcting
  * -- tab key to allow focus to shift
*******************************************************/
var filter = [];

//since we're looking for phone numbers, we need
//to allow digits 0 - 9 (they can come from either
//the numeric keys or the numpad)
const keypadZero = 48;
const numpadZero = 96;

//add key codes for digits 0 - 9 into this filter
for(var i = 0; i <= 9; i++){
  filter.push(i + keypadZero);
  filter.push(i + numpadZero);  
}

//add other keys that might be needed for navigation
//or for editing the keyboard input
filter.push(8);     //backspace
filter.push(9);     //tab
filter.push(46);    //delete
filter.push(37);    //left arrow
filter.push(39);    //right arrow
filter.push(86);    // ctrl + v
filter.push(116);    // ctrl + f5 or f5
/*******************************************************
  * replaceAll
  * returns a string where all occurrences of a
  * string 'search' are replaced with another 
  * string 'replace' in a string 'src'
*******************************************************/
function replaceAll(src,search,replace){
  return src.split(search).join(replace);
}

/*******************************************************
  * formatPhoneText
  * returns a string that is in XXX-XXX-XXXX format
*******************************************************/
function formatPhoneText(value){
  value = this.replaceAll(value.trim(),"-","");
  
  if(value.length > 3 && value.length <= 6) 
    value = value.slice(0,3) + "-" + value.slice(3);
  else if(value.length > 6) 
    value = value.slice(0,3) + "-" + value.slice(3,6) + "-" + value.slice(6);
  
  return value;
}

/*******************************************************
  * validatePhone
  * return true if the string 'p' is a valid phone
*******************************************************/
function validatePhone(p){
  var phoneRe = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
  var digits = p.replace(/\D/g, "");
  return phoneRe.test(digits);
}

/*******************************************************
  * onKeyDown(e)
  * when a key is pressed down, check if it is allowed
  * or not. If not allowed, prevent the key event
  * from propagating further
*******************************************************/
function onKeyDown(e){  
  if(filter.indexOf(e.keyCode) < 0){
    e.preventDefault();
    return false;
  }  
}

/*******************************************************
  * onKeyUp(e)
  * when a key is pressed up, grab the contents in that
  * input field, format them in line with XXX-XXX-XXXX
  * format and validate if the text is infact a complete
  * phone number. Adjust the border color based on the
  * result of that validation
*******************************************************/
function onKeyUp(e){
  var input = e.target;
  var formatted = formatPhoneText(input.value);
//   var isError = (validatePhone(formatted) || formatted.length == 0);
//   var color =  (isError) ? "gray" : "red";
//   var borderWidth =  (isError)? "1px" : "3px";
//   input.style.borderColor = color;
//   input.style.borderWidth = borderWidth;
  input.value = formatted;
}

/*******************************************************
  * setupPhoneFields
  * Now let's rig up all the fields with the specified
  * 'className' to work like phone number input fields
*******************************************************/
function setupPhoneFields(className){
  var lstPhoneFields = document.getElementsByClassName(className);
  
  for(var i=0; i < lstPhoneFields.length; i++){
    var input = lstPhoneFields[i];
    if(input.type.toLowerCase() == "text"){
     // input.placeholder = "Enter a phone Mobile Number";
      input.addEventListener("keydown", onKeyDown);
      input.addEventListener("keyup", onKeyUp);
    }
  }
}

//MAIN
setupPhoneFields("phoneNumber");

  /*END adding dashes for mobile number https://medium.com/@asimmittal/building-a-phone-input-field-in-javascript-from-scratch-a85bb2a3b3d3*/
  $(document).on('change', '.div-toggle', function() {
    var target = $(this).data('target');
    var show = $("option:selected", this).data('show');
    $(target).children().addClass('panel1');
    $(show).removeClass('panel1');
});

$(document).ready(function(){
    $('.div-toggle').trigger('change');
});

    $(document).ready(function(){
        $('.car_type').on('change', function (e) {
            var $t = $(this),
                target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
            
            $(target)
            .find("input,textarea,select")
                .attr('value','')
                .end()
            .find("input[type=checkbox], input[type=radio]" )
                .prop("checked", "")
                .end()
                .find("#one").removeAttr('id');
            $selSubCat = $(this).val();
            if($selSubCat == 1 || $selSubCat == 2 ) {
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostFirstGroup"); 
                $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 3 || $selSubCat == 30 || $selSubCat == 31 || $selSubCat == 33){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostSecondGroup");
                alert("514::"+$selSubCat);
                $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 4){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostThirdGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 5){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostFourthGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 6){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostFifthGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            }  else if($selSubCat == 7){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostSixthGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            }   else if($selSubCat == 8){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostSevenGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            }    else if($selSubCat == 9 || $selSubCat == 10 || $selSubCat == 11 || $selSubCat == 12 || $selSubCat == 13 || $selSubCat == 14 || $selSubCat == 15 || $selSubCat == 16 || $selSubCat == 17 || $selSubCat == 18 || $selSubCat == 19 || $selSubCat == 20 ){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostEightGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 21 || $selSubCat == 22 || $selSubCat == 23 || $selSubCat == 24 || $selSubCat == 25){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostNineGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            }  else if($selSubCat == 28 || $selSubCat == 29){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostTenGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            }   else if($selSubCat == 32){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostThirteenGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 34 || $selSubCat == 35 || $selSubCat == 36 || $selSubCat == 37){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostElevenGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } else if($selSubCat == 38 || $selSubCat == 39 || $selSubCat == 40 || $selSubCat == 41 || $selSubCat == 42 || $selSubCat == 43 || $selSubCat == 44 || $selSubCat == 45 || $selSubCat == 46 || $selSubCat == 47){
                $("#multi-form-id").attr("action", "http://localhost/manast_curl_changes/add-post.php/addPostTwelveGroup");
                alert("514::"+$selSubCat);
               $("input[name=st-city]").attr('value', "St Louis, MO");
                $("input[name=st-country]").attr('value', "USA");
            } 
            
               
            
        });


    }); 

    //validation starts from here    
    
    var category = document.getElementById("category");
    var subCategory = document.getElementById("subcategories");

    function categorySubcategory(){
        if(document.getElementById("category").options[document.getElementById("category").selectedIndex].value === "0" ){
            subCategory.length = 1;
        }
    }
    categorySubcategory();

    function multiFormValidation(){
        
        if(document.getElementById("category").options[document.getElementById("category").selectedIndex].value === "0" ){
            category.classList.add("placeholder_color_border");                    
            categoryOptionText =  category.options[category.selectedIndex].text = "Please Select Category";
            category.focus();
            category.onclick = function(){
                
                category.classList.remove("placeholder_color_border");
            }
            return false;
        } else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value === "0"){
            subCategory.classList.add("placeholder_color_border");
             subCategoryOptionText =  subCategory.options[subCategory.selectedIndex].text = "Please Select Sub Category";
            subCategory.focus();
            subCategory.onclick = function(){
                subCategory.classList.remove("placeholder_color_border");
            }
            return false;
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 1 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 2){
            /* for tourist, useful places title*/
            var postTitle = document.getElementById("tourist_title"); 
            var postTitleValue = postTitle.value;
            var postTitleValuetrim =postTitleValue.trim();
            if(postTitleValuetrim == null || postTitleValuetrim == "" || postTitleValuetrim.length < 3){
                postTitle.placeholder = "Please Flll this Field";
                postTitle.value = "";
                postTitle.classList.add("placeholder_color_border");
                postTitle.focus();
                postTitle.onclick = function(){
                    postTitle.classList.remove("placeholder_color_border");
                    postTitle.value = postTitleValuetrim;
                }
                postTitle.onkeydown = function(){
                    postTitle.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
             /* for tourist, useful places title*/
            /* for tourist, useful places images*/
            var imageFile = document.getElementById("image-file");
            var imageFileValue = document.getElementById("image-file").value;
            var imageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
            if(!imageFileValue.match(imageRegex)){
                imageFile.classList.add("placeholder_color_border", "image-files");
                imageFile.title = "Please select correct extensions";
                imageFile.focus();
                imageFile.onclick = function(){
                    imageFile.classList.remove("placeholder_color_border", "image-files");
                }
                return false;
            }
            var imageSize = imageFile.files[0].size;
            if( (imageSize /1024 /1024) > 1){
                imageFile.classList.add("placeholder_color_border", "image-files-one");
                imageFile.title = "Your File Should Be less Than 1 MB";
                imageFile.focus();
                imageFile.onclick = function(){
                    imageFile.classList.remove("placeholder_color_border", "image-files-one");
                }
                return false;
           }
           var imageFileLengthStlouis = imageFile.files.length;
           if (imageFileLengthStlouis > 3){
                imageFile.classList.add("placeholder_color_border", "image-files-two");
                imageFile.title = "Please Upload only three images";
                imageFile.focus();
                imageFile.onclick = function(){
                    imageFile.classList.remove("placeholder_color_border", "image-files-two");
                }
               
                return false;
           }
    
            /* for tourist, useful places images*/
            /* for tourist, useful places url*/                          
                var stlouisUrl = document.getElementById("stlouis-url");               
                var stlouisUrlValue = document.getElementById("stlouis-url").value.trim();               
                var stLouisUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
                var stLouisUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
                
                
                if(stlouisUrlValue =="" || stlouisUrlValue == null ){
                    stlouisUrl.placeholder = "Please Flll this Field";
                    stlouisUrl.classList.add("placeholder_color_border");
                    stlouisUrl.focus();
                    stlouisUrl.onclick = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                    }
                    stlouisUrl.onkeydown = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }else if(!stlouisUrlValue.match(stLouisUrlRegex1)){
                    stlouisUrl.placeholder = "Please Enter www.";
                    stlouisUrl.value = "";
                    stlouisUrl.classList.add("placeholder_color_border");
                    stlouisUrl.focus();
                    stlouisUrl.onclick = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                        stlouisUrl.value = stlouisUrlValue;
                    }
                    stlouisUrl.onkeydown = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }if(!stlouisUrlValue.match(stLouisUrlRegex2)){
                    stlouisUrl.placeholder = "Please Enter http or https correctly";
                    stlouisUrl.value = "";
                    stlouisUrl.classList.add("placeholder_color_border");
                    stlouisUrl.focus();
                    stlouisUrl.onclick = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                        stlouisUrl.value = stlouisUrlValue;
                    }
                    stlouisUrl.onkeydown = function(){
                        stlouisUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for tourist, useful places url*/
    
             /* tourist, useful places email and mobile*/
                var stlouisEmail = document.getElementById("stlouis-email");
                var stlouisMobile = document.getElementById("stlouis-mobile");
                var stlouisEmailValue = stlouisEmail.value.trim();
                var stlouisMobileValue = stlouisMobile.value.trim();
                var stlouisEmailValueLength = stlouisEmailValue.length;
                var stlouisMobileValueLength = stlouisMobileValue.length;
                var stlouisEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var stlouisMobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
                
                if(!stlouisEmailValueLength && !stlouisMobileValueLength){
                    stlouisEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                    stlouisMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                    stlouisEmail.classList.add("placeholder_color_border");
                    stlouisMobile.classList.add("placeholder_color_border");
                    stlouisEmail.focus();
                    stlouisEmail.onclick = function(){
                        stlouisEmail.classList.remove("placeholder_color_border");
                        stlouisMobile.classList.remove("placeholder_color_border");
                    }
                    stlouisEmail.onkeydown = function(){
                        stlouisEmail.classList.remove("placeholder_color_border");
                        stlouisMobile.classList.remove("placeholder_color_border");
                    }
                    stlouisMobile.onclick = function(){
                        stlouisEmail.classList.remove("placeholder_color_border");
                        stlouisMobile.classList.remove("placeholder_color_border");
                    }
                    stlouisMobile.onkeydown = function(){
                        stlouisEmail.classList.remove("placeholder_color_border");
                        stlouisMobile.classList.remove("placeholder_color_border");
                    }
                    return false;
                }else if(!stlouisEmailValue.match(stlouisEmailRegEx) && !stlouisMobileValue.match(stlouisMobileRegEx)){
                    
                    if(!stlouisEmailValue.match(stlouisEmailRegEx)){
                        stlouisEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                        stlouisEmail.classList.add("placeholder_color_border");
                        stlouisEmail.value = "";
                        stlouisEmail.focus();
                        stlouisEmail.onclick = function(){
                            stlouisEmail.classList.remove("placeholder_color_border");
                            stlouisMobile.classList.remove("placeholder_color_border");
                            stlouisEmail.value = stlouisEmailValue;
                        }
                        stlouisEmail.onkeydown = function(){
                            stlouisEmail.classList.remove("placeholder_color_border");
                            stlouisMobile.classList.remove("placeholder_color_border");
                        }
                        return false;
    
                    }
                    if(!stlouisMobileValue.match(stlouisMobileRegEx)){
                        stlouisMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";                
                        stlouisMobile.classList.add("placeholder_color_border");                
                        stlouisMobile.value = "";                           
                        stlouisMobile.onclick = function(){
                            stlouisEmail.classList.remove("placeholder_color_border");
                            stlouisMobile.classList.remove("placeholder_color_border");
                            stlouisMobile.value = stlouisMobileValue;
                        }
                        stlouisMobile.onkeydown = function(){
                            stlouisEmail.classList.remove("placeholder_color_border");
                            stlouisMobile.classList.remove("placeholder_color_border");
                        }
                        return false;
                    }
                    
                }
                
            /* END tourist, useful places email and mobile*/
    
    
    
            /* for tourist, useful places  location*/
            var stlouisLocation = document.getElementById("stlouis-location");
            var stlouisLocationValue = stlouisLocation.value.trim();
            var stLouisLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var stLouisLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!stlouisLocationValue.match(stLouisLocationRegex) || stlouisLocationValue.match(stLouisLocationRegex1)){
                stlouisLocation.placeholder = "please Enter Correct Location";
                stlouisLocation.value = "";
                stlouisLocation.classList.add("placeholder_color_border");
                stlouisLocation.focus();
                stlouisLocation.onclick = function(){
                    stlouisLocation.classList.remove("placeholder_color_border");
                    stlouisLocation.value = stlouisLocationValue;
                }
                stlouisLocation.onkeydown = function(){
                    stlouisLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
    
    
            }
            /* END for tourist, useful places  location*/
            /* for tourist, useful places Street*/
            var stlouisStreet = document.getElementById("stlouis-street");
            var stlouisStreetValue = stlouisStreet.value.trim();
            var stlouisStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var stlouisStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!stlouisStreetValue.match(stlouisStreetRegex) || stlouisStreetValue.match(stlouisStreetRegex1)){
                stlouisStreet.placeholder = "please Enter Correct Street";
                stlouisStreet.value = "";
                stlouisStreet.classList.add("placeholder_color_border");
                stlouisStreet.focus();
                stlouisStreet.onclick = function(){
                    stlouisStreet.classList.remove("placeholder_color_border");
                    stlouisStreet.value = stlouisStreetValue;
                }
                stlouisStreet.onkeydown = function(){
                    stlouisStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for tourist, useful places Street*/
            /* for tourist, useful places State and city*/        
    
            /* END for tourist, useful places State and city*/
            /* for tourist, useful places Zip Code*/
            var stlouisZipCode = document.getElementById("stlouis-zip");
            var stlouisZipCodeValue = stlouisZipCode.value.trim();
            var stlouisZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(stlouisZipCodeValue == null || stlouisZipCodeValue == "" || !stlouisZipCodeValue.match(stlouisZipCodeRegEx)){
                stlouisZipCode.placeholder = "please Enter Correct Zip Code";
                stlouisZipCode.value = "";
                stlouisZipCode.classList.add("placeholder_color_border");
                stlouisZipCode.focus();
                stlouisZipCode.onclick = function(){
                    stlouisZipCode.classList.remove("placeholder_color_border");
                    stlouisZipCode.value = stlouisZipCodeValue;
                }
                stlouisZipCode.onkeydown = function(){
                    stlouisZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for tourist, useful places Zip Code*/
            /* for tourist, useful places Country*/
            
            /* END for tourist, useful places Country*/
            
            /* for tourist, useful places check box*/
            var stlouisCheckBox = document.getElementsByClassName("stlouis-checkbox");
            var stlouisCheckBoxChecked = false;
            var stlouisCheckboxErrorMessage = document.getElementById("stlouisCheckBoxErrorMessage");
            for( i = 0;i < stlouisCheckBox.length; i++ ){
    
                if(stlouisCheckBox[i].checked){
                    stlouisCheckBoxChecked=true;
                    break;
                }               
    
            }
            if(stlouisCheckBoxChecked == false){
                stlouisCheckboxErrorMessage.innerHTML = "please check atleast one check box";
                stlouisCheckboxErrorMessage.classList.add("error_msg_box");
                stlouisCheckBox[0].focus();
                for( i = 0;i < stlouisCheckBox.length; i++ ){
                    stlouisCheckBox[i].onclick = function(){
                        stlouisCheckboxErrorMessage.classList.remove("error_msg_box");
                        stlouisCheckboxErrorMessage.innerHTML = "";
                    }
                }    
                return false;
            }
            
            /* END for tourist, useful places check box*/
            /* for tourist, useful places time*/
                var outterTime = document.getElementsByClassName("stlouis-time-one");
                var openHourErrorMessage = document.getElementById("open-hour-error-message");
                for(i = 0; i < outterTime.length ; i++){                
                    if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                        openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                        openHourErrorMessage.classList.add("error_msg_box");
                        for( i = 0;i < outterTime.length; i++ ){
                                outterTime[i].classList.add("placeholder_color_border");
                                outterTime[i].focus();
                                outterTime[i].onclick = function(){   
                                    for( i = 0;i < outterTime.length; i++ ){                         
                                        outterTime[i].classList.remove("placeholder_color_border");
                                    }    
                                    openHourErrorMessage.innerHTML = "";
                                    openHourErrorMessage.classList.remove("error_msg_box");
                            }
                        }
                        return false;
                    }
                }
            /* END for tourist, useful places time*/
            /*  for tourist, useful places textarea*/
            var stlouisDescription = document.getElementById("stlouis-description");
            var stlouisDescriptionValue = stlouisDescription.value.trim();
            if(stlouisDescriptionValue == null || stlouisDescriptionValue == ""){
                stlouisDescription.placeholder = "Field Cannot Be empty";           
                stlouisDescription.classList.add("placeholder_color_border");
                stlouisDescription.focus();
                stlouisDescription.onclick = function(){
                    stlouisDescription.classList.remove("placeholder_color_border");
                    
                }
                stlouisDescription.onkeydown = function(){
                    stlouisDescription.classList.remove("placeholder_color_border");                
                }
                
                return false;
            }else  if(stlouisDescriptionValue.length < 3){
                stlouisDescription.placeholder = "Please Enter Atleast 3 Characters";
                stlouisDescription.value = "";
                stlouisDescription.classList.add("placeholder_color_border");
                stlouisDescription.focus();
                stlouisDescription.onclick = function(){
                    stlouisDescription.classList.remove("placeholder_color_border");
                    stlouisDescription.value = stlouisDescriptionValue;
                }
                
                return false;
            }
            /* END for tourist, useful places textarea*/
    
        } else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 4){
            /*unversities title*/
            var unversitiesTitle = document.getElementById("universities-title");
            var unversitiesTitleValue = unversitiesTitle.value.trim();
            if(unversitiesTitleValue == null || unversitiesTitleValue == ""){
                unversitiesTitle.placeholder = "Please Fill This Field";
                unversitiesTitle.classList.add("placeholder_color_border");
                unversitiesTitle.focus();
                unversitiesTitle.onclick = function(){
                    unversitiesTitle.classList.remove("placeholder_color_border");
                }
                unversitiesTitle.onkeydown = function(){
                    unversitiesTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(unversitiesTitleValue.length < 4){
                unversitiesTitle.placeholder = "Please Enter Atleast Four Characters";
                unversitiesTitle.classList.add("placeholder_color_border");
                unversitiesTitle.value = "";
                unversitiesTitle.focus();
                unversitiesTitle.onclick = function(){
                    unversitiesTitle.classList.remove("placeholder_color_border");
                    unversitiesTitle.value = unversitiesTitleValue;
                }
                unversitiesTitle.onkeydown = function(){
                    unversitiesTitle.classList.remove("placeholder_color_border");
                   // unversitiesTitle.value = unversitiesTitleValue;
                }
                return false;
            }
            /*END unversities title*/
             /* for unversities images*/
             var imageFileUniversities = document.getElementById("image-file-universities");
             var imageFileUniversitiesValue = imageFileUniversities.value;
             var imageRegexUniversities = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
             if(!imageFileUniversitiesValue.match(imageRegexUniversities)){
                imageFileUniversities.classList.add("placeholder_color_border", "image-files");
                imageFileUniversities.title = "Please select correct extensions";
                imageFileUniversities.focus();
                imageFileUniversities.onclick = function(){
                    imageFileUniversities.classList.remove("placeholder_color_border", "image-files");
                 }
                 return false;
             }
             var imageFileUniversitiesSize = imageFileUniversities.files[0].size;
             if( (imageFileUniversitiesSize /1024 /1024) > 1){
                imageFileUniversities.classList.add("placeholder_color_border", "image-files-one");
                 imageFileUniversities.title = "Your File Should Be less Than 1 MB";
                 imageFileUniversities.focus();
                 imageFileUniversities.onclick = function(){
                     imageFileUniversities.classList.remove("placeholder_color_border", "image-files-one");
                 }
                 return false;
            }
            var imageFileUniversitiesLength = imageFileUniversities.files.length;
            if (imageFileUniversitiesLength > 3){
                 imageFileUniversities.classList.add("placeholder_color_border", "image-files-two");
                 imageFileUniversities.title = "Please Upload only three images";
                 imageFileUniversities.focus();
                 imageFileUniversities.onclick = function(){
                     imageFileUniversities.classList.remove("placeholder_color_border", "image-files-two");
                 }
                
                 return false;
            }
     
             /* END Universities images*/
             /* for Universities url*/                          
             var universitiesUrl = document.getElementById("universities-url");               
             var universitiesUrlvalue = universitiesUrl.value.trim();               
             var universitiesUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             var universitiesUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             
             
             if(universitiesUrlvalue =="" || universitiesUrlvalue == null ){
                universitiesUrl.placeholder = "Please Flll this Field";
                universitiesUrl.classList.add("placeholder_color_border");
                universitiesUrl.focus();
                universitiesUrl.onclick = function(){
                    universitiesUrl.classList.remove("placeholder_color_border");
                 }
                 universitiesUrl.onkeydown = function(){
                    universitiesUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }else if(!universitiesUrlvalue.match(universitiesUrlRegex1)){
                 universitiesUrl.placeholder = "Please Enter www.";
                 universitiesUrl.value = "";
                 universitiesUrl.classList.add("placeholder_color_border");
                 universitiesUrl.focus();
                 universitiesUrl.onclick = function(){
                     universitiesUrl.classList.remove("placeholder_color_border");
                     universitiesUrl.value = universitiesUrlvalue;
                 }
                 universitiesUrl.onkeydown = function(){
                    universitiesUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }if(!universitiesUrlvalue.match(universitiesUrlRegex2)){
                 universitiesUrl.placeholder = "Please Enter http or https correctly";
                 universitiesUrl.value = "";
                 universitiesUrl.classList.add("placeholder_color_border");
                 universitiesUrl.focus();
                 universitiesUrl.onclick = function(){
                     universitiesUrl.classList.remove("placeholder_color_border");
                     universitiesUrl.value = universitiesUrlvalue;
                 }
                 universitiesUrl.onkeydown = function(){
                     universitiesUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }
         /* END Universities url*/
         /* universities email and mobile*/
             var universitiesEmail = document.getElementById("universities-email");
             var universitiesMobile = document.getElementById("universities-mobile");
             var universitiesEmailValue = universitiesEmail.value.trim();
             var universitiesMobileValue = universitiesMobile.value.trim();
             var universitiesEmailValueLength = universitiesEmailValue.length;
             var universitiesMobileValueLength = universitiesMobileValue.length;
             var universitiesEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
             var universitiesmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
    
             if(!universitiesEmailValueLength && !universitiesMobileValueLength){
                universitiesEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                universitiesMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                universitiesEmail.classList.add("placeholder_color_border");
                universitiesMobile.classList.add("placeholder_color_border");
                universitiesEmail.focus();
                universitiesMobile.focus();
                universitiesEmail.onclick = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                universitiesEmail.onkeydown = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                universitiesMobile.onclick = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                universitiesMobile.onkeydown = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                return false;
             }else if(!universitiesEmailValue.match(universitiesEmailRegEx) && !universitiesMobileValue.match(universitiesmobileRegEx)){
                
                universitiesEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                universitiesMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                universitiesEmail.classList.add("placeholder_color_border");
                universitiesMobile.classList.add("placeholder_color_border");
                universitiesEmail.value = "";
                universitiesMobile.value = "";
                universitiesEmail.focus();
                universitiesMobile.focus();
                universitiesEmail.onclick = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                    universitiesEmail.value = universitiesEmailValue;
                    universitiesMobile.value = universitiesMobileValue;
                }
                universitiesEmail.onkeydown = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                universitiesMobile.onclick = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                    universitiesEmail.value = universitiesEmailValue;
                    universitiesMobile.value = universitiesMobileValue;
                }
                universitiesMobile.onkeydown = function(){
                    universitiesEmail.classList.remove("placeholder_color_border");
                    universitiesMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
             }
             
         /* END universities email and mobile*/
         /*  universities location*/
         /* for universities  location*/
         var universitiesLocation = document.getElementById("universities-location");
         var universitiesLocationValue = universitiesLocation.value.trim();
         var universitiesLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var universitiesLocationRegex = /([a-zA-Z0-9-. ]+)?/;
         if(!universitiesLocationValue.match(universitiesLocationRegex) || universitiesLocationValue.match(universitiesLocationRegex1)){
             universitiesLocation.placeholder = "please Enter Correct Location";
             universitiesLocation.value = "";
             universitiesLocation.classList.add("placeholder_color_border");
             universitiesLocation.focus();
             universitiesLocation.onclick = function(){
                 universitiesLocation.classList.remove("placeholder_color_border");
                 universitiesLocation.value = universitiesLocationValue;
             }
             universitiesLocation.onkeydown = function(){
                 universitiesLocation.classList.remove("placeholder_color_border");
                 
             }
             return false;
    
    
         }
         /* END for universities  location*/
         /* for universities Street*/
         var universitiesStreet = document.getElementById("universities-street");
         var universitiesStreetValue = universitiesStreet.value.trim();
         var universitiesStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var universitiesStreetRegex = /([a-zA-Z0-9 .-]+)?/;
         if(!universitiesStreetValue.match(universitiesStreetRegex) || universitiesStreetValue.match(universitiesStreetRegex1)){
             universitiesStreet.placeholder = "please Enter Correct Street";
             universitiesStreet.value = "";
             universitiesStreet.classList.add("placeholder_color_border");
             universitiesStreet.focus();
             universitiesStreet.onclick = function(){
                 universitiesStreet.classList.remove("placeholder_color_border");
                 universitiesStreet.value = universitiesStreetValue;
             }
             universitiesStreet.onkeydown = function(){
                 universitiesStreet.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for universities Street*/
         /* for universities State and city*/        
    
         /* END for universities State and city*/
         /* for universities Zip Code*/
         var universitiesZipCode = document.getElementById("universities-zip");
         var universitiesZipCodeValue = universitiesZipCode.value.trim();
         var universitiesZipCodeRegEx = /(^(631)+\d{2}$)/;
         if(universitiesZipCodeValue == null || universitiesZipCodeValue == "" || !universitiesZipCodeValue.match(universitiesZipCodeRegEx)){
             universitiesZipCode.placeholder = "please Enter Correct Zip Code";
             universitiesZipCode.value = "";
             universitiesZipCode.classList.add("placeholder_color_border");
             universitiesZipCode.focus();
             universitiesZipCode.onclick = function(){
                 universitiesZipCode.classList.remove("placeholder_color_border");
                 universitiesZipCode.value = universitiesZipCodeValue;
             }
             universitiesZipCode.onkeydown = function(){
                 universitiesZipCode.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for universities Zip Code*/
         /* for universities price */
         var universitiesFee = document.getElementById("universities-application-fee");
         var universitiesFeeValue = universitiesFee.value.trim();
         var universitiesFeeRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
         if(!universitiesFeeValue.match(universitiesFeeRegEx)){
            universitiesFee.placeholder = "please Enter Application Fee ";
            universitiesFee.value = "";
            universitiesFee.classList.add("placeholder_color_border");
            universitiesFee.focus();
            universitiesFee.onclick = function(){
                universitiesFee.classList.remove("placeholder_color_border");
                universitiesFee.value = universitiesFeeValue;
            }
            universitiesFee.onkeydown = function(){
                universitiesFee.classList.remove("placeholder_color_border");
                 
            }
            return false;
        }
        /* END for universities price */
        /*  for universities intakes */
            var universitiesIntakes = document.getElementById("universities-intakes");
            var universitiesIntakesOptionValue = universitiesIntakes.options[universitiesIntakes.selectedIndex].value;
            if(universitiesIntakesOptionValue == 0){
                universitiesIntakes.classList.add("placeholder_color_border");
                universitiesIntakesOptionText =  universitiesIntakes.options[universitiesIntakes.selectedIndex].text = "Please Select Intakes";
               universitiesIntakes.focus();
               universitiesIntakes.onclick = function(){
                   universitiesIntakes.classList.remove("placeholder_color_border");
               }
                return false;
            }
        /* END for universities intakes */
        /*  for universities checkBox */
            var universitiesOpenDays = document.getElementsByClassName("universities-open-days");
            var universitiesOpenDaysChecked = false;
            var universitiesOpenDaysCheckedBoxErrorMessage = document.getElementById("universitiesCheckBoxErrorMessage");
            for( i = 0;i < universitiesOpenDays.length; i++ ){
    
                if(universitiesOpenDays[i].checked){
                    universitiesOpenDaysChecked=true;
                    break;
                }               
    
            }
            if(universitiesOpenDaysChecked == false){
                universitiesOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
                universitiesOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
                universitiesOpenDays[0].focus();
                for( i = 0;i < universitiesOpenDays.length; i++ ){
                    universitiesOpenDays[i].onclick = function(){
                        universitiesOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        universitiesOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
                return false;
            }
        /* END for universities checkBox */
        /*  for universities Description */
            var universitiesDescription = document.getElementById("universities-description");
            var universitiesDescriptionValue = universitiesDescription.value.trim();
            if(universitiesDescriptionValue == null || universitiesDescriptionValue == "" || universitiesDescriptionValue.length < 3){
                universitiesDescription.placeholder = "please Enter Atleast Three Characters";
                universitiesDescription.value = "";
                universitiesDescription.classList.add("placeholder_color_border");
                universitiesDescription.focus();
                universitiesDescription.onclick = function(){
                    universitiesDescription.classList.remove("placeholder_color_border");
                    universitiesDescription.value = universitiesDescriptionValue;
                }
                universitiesDescription.onkeydown = function(){
                    universitiesDescription.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
        /* END for universities Description */
        
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 5){
            /*placeof worship title*/
            var placeofworshipTitle = document.getElementById("placeofworship-title");
            var placeofworshipTitleValue = placeofworshipTitle.value.trim();
            if(placeofworshipTitleValue == null || placeofworshipTitleValue == ""){
                placeofworshipTitle.placeholder = "Please Fill This Field";
                placeofworshipTitle.classList.add("placeholder_color_border");
                placeofworshipTitle.focus();
                placeofworshipTitle.onclick = function(){
                    placeofworshipTitle.classList.remove("placeholder_color_border");
                }
                placeofworshipTitle.onkeydown = function(){
                    placeofworshipTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(placeofworshipTitleValue.length < 4){
                placeofworshipTitle.placeholder = "Please Enter Atleast Four Characters";
                placeofworshipTitle.classList.add("placeholder_color_border");
                placeofworshipTitle.value = "";
                placeofworshipTitle.focus();
                placeofworshipTitle.onclick = function(){
                    placeofworshipTitle.classList.remove("placeholder_color_border");
                    placeofworshipTitle.value = placeofworshipTitleValue;
                }
                placeofworshipTitle.onkeydown = function(){
                    placeofworshipTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END placeofwhorship title*/
             /* for placeofwhorship images*/
             var placeofworshipImageFile = document.getElementById("placeofworship-image-file");
             var placeofworshipImageFileValue = placeofworshipImageFile.value;
             var placeofworshipImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
             if(!placeofworshipImageFileValue.match(placeofworshipImageRegex)){
                placeofworshipImageFile.classList.add("placeholder_color_border", "image-files");
                placeofworshipImageFile.title = "Please select correct extensions";
                placeofworshipImageFile.focus();
                placeofworshipImageFile.onclick = function(){
                    placeofworshipImageFile.classList.remove("placeholder_color_border", "image-files");
                 }
                 return false;
             }
             var placeofworshipImageFileSize = placeofworshipImageFile.files[0].size;
             if( (placeofworshipImageFileSize /1024 /1024) > 1){
                placeofworshipImageFile.classList.add("placeholder_color_border", "image-files-one");
                 placeofworshipImageFile.title = "Your File Should Be less Than 1 MB";
                 placeofworshipImageFile.focus();
                 placeofworshipImageFile.onclick = function(){
                     placeofworshipImageFile.classList.remove("placeholder_color_border", "image-files-one");
                 }
                 return false;
            }
            var placeofworshipImageFileLength = placeofworshipImageFile.files.length;
            if (placeofworshipImageFileLength > 3){
                 placeofworshipImageFile.classList.add("placeholder_color_border", "image-files-two");
                 placeofworshipImageFile.title = "Please Upload only three images";
                 placeofworshipImageFile.focus();
                 placeofworshipImageFile.onclick = function(){
                     placeofworshipImageFile.classList.remove("placeholder_color_border", "image-files-two");
                 }
                
                 return false;
            }
     
             /* END palceofworship images*/
             /* for palceofworship url*/                          
             var placeofworshipUrl = document.getElementById("placeofworship-url");               
             var placeofworshipUrlvalue = placeofworshipUrl.value.trim();               
             var placeofworshipUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             var placeofworshipUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             
             
             if(placeofworshipUrlvalue =="" || placeofworshipUrlvalue == null ){
                placeofworshipUrl.placeholder = "Please Flll this Field";
                placeofworshipUrl.classList.add("placeholder_color_border");
                placeofworshipUrl.focus();
                placeofworshipUrl.onclick = function(){
                    placeofworshipUrl.classList.remove("placeholder_color_border");
                 }
                 placeofworshipUrl.onkeydown = function(){
                    placeofworshipUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }else if(!placeofworshipUrlvalue.match(placeofworshipUrlRegex1)){
                 placeofworshipUrl.placeholder = "Please Enter www.";
                 placeofworshipUrl.value = "";
                 placeofworshipUrl.classList.add("placeholder_color_border");
                 placeofworshipUrl.focus();
                 placeofworshipUrl.onclick = function(){
                     placeofworshipUrl.classList.remove("placeholder_color_border");
                     placeofworshipUrl.value = placeofworshipUrlvalue;
                 }
                 placeofworshipUrl.onkeydown = function(){
                    placeofworshipUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }if(!placeofworshipUrlvalue.match(placeofworshipUrlRegex2)){
                 placeofworshipUrl.placeholder = "Please Enter http or https correctly";
                 placeofworshipUrl.value = "";
                 placeofworshipUrl.classList.add("placeholder_color_border");
                 placeofworshipUrl.focus();
                 placeofworshipUrl.onclick = function(){
                     placeofworshipUrl.classList.remove("placeholder_color_border");
                     placeofworshipUrl.value = placeofworshipUrlvalue;
                 }
                 placeofworshipUrl.onkeydown = function(){
                     placeofworshipUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }
         /* END placeofworship url*/
         
         /*  placeofworship location*/
         /* for placeofworship  location*/
         var placeofworshipLocation = document.getElementById("placeofworship-location");
         var placeofworshipLocationValue = placeofworshipLocation.value.trim();
         var placeofworshipLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var placeofworshipLocationRegex = /([a-zA-Z0-9-. ]+)?/;
         if(!placeofworshipLocationValue.match(placeofworshipLocationRegex) || placeofworshipLocationValue.match(placeofworshipLocationRegex1)){
             placeofworshipLocation.placeholder = "please Enter Correct Location";
             placeofworshipLocation.value = "";
             placeofworshipLocation.classList.add("placeholder_color_border");
             placeofworshipLocation.focus();
             placeofworshipLocation.onclick = function(){
                 placeofworshipLocation.classList.remove("placeholder_color_border");
                 placeofworshipLocation.value = placeofworshipLocationValue;
             }
             placeofworshipLocation.onkeydown = function(){
                 placeofworshipLocation.classList.remove("placeholder_color_border");
                 
             }
             return false;
    
    
         }
         /* END for placeofworship  location*/
         /* for placeofworship Street*/
         var placeofworshipStreet = document.getElementById("placeofworship-street");
         var placeofworshipStreetValue = placeofworshipStreet.value.trim();
         var placeofworshipStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var placeofworshipStreetRegex = /([a-zA-Z0-9 .-]+)?/;
         if(!placeofworshipStreetValue.match(placeofworshipStreetRegex) || placeofworshipStreetValue.match(placeofworshipStreetRegex1)){
             placeofworshipStreet.placeholder = "please Enter Correct Street";
             placeofworshipStreet.value = "";
             placeofworshipStreet.classList.add("placeholder_color_border");
             placeofworshipStreet.focus();
             placeofworshipStreet.onclick = function(){
                 placeofworshipStreet.classList.remove("placeholder_color_border");
                 placeofworshipStreet.value = placeofworshipStreetValue;
             }
             placeofworshipStreet.onkeydown = function(){
                 placeofworshipStreet.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for placeofworship Street*/
         /* for placeofworship State and city*/        
    
         /* END for placeofworship State and city*/
         /* for placeofworship Zip Code*/
         var placeofworshipZipCode = document.getElementById("placeofworship-zip");
         var placeofworshipZipCodeValue = placeofworshipZipCode.value.trim();
         var placeofworshipZipCodeRegEx = /(^(631)+\d{2}$)/;
         if(placeofworshipZipCodeValue == null || placeofworshipZipCodeValue == "" || !placeofworshipZipCodeValue.match(placeofworshipZipCodeRegEx)){
             placeofworshipZipCode.placeholder = "please Enter Correct Zip Code";
             placeofworshipZipCode.value = "";
             placeofworshipZipCode.classList.add("placeholder_color_border");
             placeofworshipZipCode.focus();
             placeofworshipZipCode.onclick = function(){
                 placeofworshipZipCode.classList.remove("placeholder_color_border");
                 placeofworshipZipCode.value = placeofworshipZipCodeValue;
             }
             placeofworshipZipCode.onkeydown = function(){
                 placeofworshipZipCode.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for placeofworship Zip Code*/
         
        /*  for placeofworship checkBox */
            var placeofworshipOpenDays = document.getElementsByClassName("placeofworship-open-days");
            var placeofworshipOpenDaysChecked = false;
            var placeofworshipOpenDaysCheckedBoxErrorMessage = document.getElementById("placeofworshipCheckBoxErrorMessage");
            for( i = 0;i < placeofworshipOpenDays.length; i++ ){
    
                if(placeofworshipOpenDays[i].checked){
                    placeofworshipOpenDaysChecked=true;
                    break;
                }               
    
            }
            if(placeofworshipOpenDaysChecked == false){
                placeofworshipOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
                placeofworshipOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
                placeofworshipOpenDays[0].focus();
                for( i = 0;i < placeofworshipOpenDays.length; i++ ){
                    placeofworshipOpenDays[i].onclick = function(){
                        placeofworshipOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        placeofworshipOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
                return false;
            }
        /* END for placeofworship checkBox */
            /* for placeofworship open Hours time*/
            var outterTime = document.getElementsByClassName("placeofworship-time-one");
            var openHourErrorMessage = document.getElementById("open-hour-error-message");
            for(i = 0; i < outterTime.length ; i++){                
                if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                    openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                    openHourErrorMessage.classList.add("error_msg_box");
                    for( i = 0;i < outterTime.length; i++ ){
                            outterTime[i].classList.add("placeholder_color_border");
                            outterTime[i].focus();
                            outterTime[i].onclick = function(){   
                                for( i = 0;i < outterTime.length; i++ ){                         
                                    outterTime[i].classList.remove("placeholder_color_border");
                                }    
                                openHourErrorMessage.innerHTML = "";
                                openHourErrorMessage.classList.remove("error_msg_box");
                        }
                    }
                    return false;
                }
            }
            /* END for placeofworship  open Hours time*/
            /* for placeofworship pooja timings time*/
            var outterTime = document.getElementsByClassName("placeofworship-time-two");
            var openHourErrorMessage = document.getElementById("open-hour-error-message-two");
            for(i = 0; i < outterTime.length ; i++){                
                if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                    openHourErrorMessage.innerHTML = "please Fill Atleast One Day pooja Timings";
                    openHourErrorMessage.classList.add("error_msg_box");
                    for( i = 0;i < outterTime.length; i++ ){
                            outterTime[i].classList.add("placeholder_color_border");
                            outterTime[i].focus();
                            outterTime[i].onclick = function(){   
                                for( i = 0;i < outterTime.length; i++ ){                         
                                    outterTime[i].classList.remove("placeholder_color_border");
                                }    
                                openHourErrorMessage.innerHTML = "";
                                openHourErrorMessage.classList.remove("error_msg_box");
                        }
                    }
                    return false;
                }
            }
            /* END for placeofworship  pooja timings time*/
        /*  for placeofworship Description */
            var placeofworshipDescription = document.getElementById("placeofworship-description");
            var placeofworshipDescriptionValue = placeofworshipDescription.value.trim();
            if(placeofworshipDescriptionValue == null || placeofworshipDescriptionValue == "" || placeofworshipDescriptionValue.length < 3){
                placeofworshipDescription.placeholder = "please Enter Atleast Three Characters";
                placeofworshipDescription.value = "";
                placeofworshipDescription.classList.add("placeholder_color_border");
                placeofworshipDescription.focus();
                placeofworshipDescription.onclick = function(){
                    placeofworshipDescription.classList.remove("placeholder_color_border");
                    placeofworshipDescription.value = placeofworshipDescriptionValue;
                }
                placeofworshipDescription.onkeydown = function(){
                    placeofworshipDescription.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
        /* END for placeofworship Description */
        
        
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 6){
            /*church title*/
            var churchTitle = document.getElementById("church-title");
            var churchTitleValue = churchTitle.value.trim();
            if(churchTitleValue == null || churchTitleValue == ""){
                churchTitle.placeholder = "Please Fill This Field";
                churchTitle.classList.add("placeholder_color_border");
                churchTitle.focus();
                churchTitle.onclick = function(){
                    churchTitle.classList.remove("placeholder_color_border");
                }
                churchTitle.onkeydown = function(){
                    churchTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(churchTitleValue.length < 4){
                churchTitle.placeholder = "Please Enter Atleast Four Characters";
                churchTitle.classList.add("placeholder_color_border");
                churchTitle.value = "";
                churchTitle.focus();
                churchTitle.onclick = function(){
                    churchTitle.classList.remove("placeholder_color_border");
                    churchTitle.value = churchTitleValue;
                }
                churchTitle.onkeydown = function(){
                    churchTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END church title*/
             /* for church images*/
             var churchImageFile = document.getElementById("church-image-file");
             var churchImageFileValue = churchImageFile.value;
             var churchImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
             if(!churchImageFileValue.match(churchImageRegex)){
                churchImageFile.classList.add("placeholder_color_border", "image-files");
                churchImageFile.title = "Please select correct extensions";
                churchImageFile.focus();
                churchImageFile.onclick = function(){
                    churchImageFile.classList.remove("placeholder_color_border", "image-files");
                 }
                 return false;
             }
             var churchImageFileSize = churchImageFile.files[0].size;
             if( (churchImageFileSize /1024 /1024) > 1){
                churchImageFile.classList.add("placeholder_color_border", "image-files-one");
                 churchImageFile.title = "Your File Should Be less Than 1 MB";
                 churchImageFile.focus();
                 churchImageFile.onclick = function(){
                     churchImageFile.classList.remove("placeholder_color_border", "image-files-one");
                 }
                 return false;
            }
            var churchImageFileLength = churchImageFile.files.length;
            if (churchImageFileLength > 3){
                 churchImageFile.classList.add("placeholder_color_border", "image-files-two");
                 churchImageFile.title = "Please Upload only three images";
                 churchImageFile.focus();
                 churchImageFile.onclick = function(){
                     churchImageFile.classList.remove("placeholder_color_border", "image-files-two");
                 }
                
                 return false;
            }
     
             /* END church images*/
             /* for church url*/                          
             var churchUrl = document.getElementById("church-url");               
             var churchUrlvalue = churchUrl.value.trim();               
             var churchUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             var churchUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             
             
             if(churchUrlvalue =="" || churchUrlvalue == null ){
                churchUrl.placeholder = "Please Flll this Field";
                churchUrl.classList.add("placeholder_color_border");
                churchUrl.focus();
                churchUrl.onclick = function(){
                    churchUrl.classList.remove("placeholder_color_border");
                 }
                 churchUrl.onkeydown = function(){
                    churchUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }else if(!churchUrlvalue.match(churchUrlRegex1)){
                 churchUrl.placeholder = "Please Enter www.";
                 churchUrl.value = "";
                 churchUrl.classList.add("placeholder_color_border");
                 churchUrl.focus();
                 churchUrl.onclick = function(){
                     churchUrl.classList.remove("placeholder_color_border");
                     churchUrl.value = churchUrlvalue;
                 }
                 churchUrl.onkeydown = function(){
                    churchUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }if(!churchUrlvalue.match(churchUrlRegex2)){
                 churchUrl.placeholder = "Please Enter http or https correctly";
                 churchUrl.value = "";
                 churchUrl.classList.add("placeholder_color_border");
                 churchUrl.focus();
                 churchUrl.onclick = function(){
                     churchUrl.classList.remove("placeholder_color_border");
                     churchUrl.value = churchUrlvalue;
                 }
                 churchUrl.onkeydown = function(){
                     churchUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }
         /* END church url*/
         
         /*  church location*/
         /* for church  location*/
         var churchLocation = document.getElementById("church-location");
         var churchLocationValue = churchLocation.value.trim();
         var churchLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var churchLocationRegex = /([a-zA-Z0-9-. ]+)?/;
         if(!churchLocationValue.match(churchLocationRegex) || churchLocationValue.match(churchLocationRegex1)){
             churchLocation.placeholder = "please Enter Correct Location";
             churchLocation.value = "";
             churchLocation.classList.add("placeholder_color_border");
             churchLocation.focus();
             churchLocation.onclick = function(){
                 churchLocation.classList.remove("placeholder_color_border");
                 churchLocation.value = churchLocationValue;
             }
             churchLocation.onkeydown = function(){
                 churchLocation.classList.remove("placeholder_color_border");
                 
             }
             return false;
    
    
         }
         /* END for church  location*/
         /* for church Street*/
         var churchStreet = document.getElementById("church-street");
         var churchStreetValue = churchStreet.value.trim();
         var churchStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var churchStreetRegex = /([a-zA-Z0-9 .-]+)?/;
         if(!churchStreetValue.match(churchStreetRegex) || churchStreetValue.match(churchStreetRegex1)){
             churchStreet.placeholder = "please Enter Correct Street";
             churchStreet.value = "";
             churchStreet.classList.add("placeholder_color_border");
             churchStreet.focus();
             churchStreet.onclick = function(){
                 churchStreet.classList.remove("placeholder_color_border");
                 churchStreet.value = churchStreetValue;
             }
             churchStreet.onkeydown = function(){
                 churchStreet.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for church Street*/
         /* for church State and city*/        
    
         /* END for church State and city*/
         /* for church Zip Code*/
         var churchZipCode = document.getElementById("church-zip");
         var churchZipCodeValue = churchZipCode.value.trim();
         var churchZipCodeRegEx = /(^(631)+\d{2}$)/;
         if(churchZipCodeValue == null || churchZipCodeValue == "" || !churchZipCodeValue.match(churchZipCodeRegEx)){
             churchZipCode.placeholder = "please Enter Correct Zip Code";
             churchZipCode.value = "";
             churchZipCode.classList.add("placeholder_color_border");
             churchZipCode.focus();
             churchZipCode.onclick = function(){
                 churchZipCode.classList.remove("placeholder_color_border");
                 churchZipCode.value = churchZipCodeValue;
             }
             churchZipCode.onkeydown = function(){
                 churchZipCode.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for church Zip Code*/
         
        /*  for church checkBox */
            var churchOpenDays = document.getElementsByClassName("church-open-days");
            var churchOpenDaysChecked = false;
            var churchOpenDaysCheckedBoxErrorMessage = document.getElementById("churchCheckBoxErrorMessage");
            for( i = 0;i < churchOpenDays.length; i++ ){
    
                if(churchOpenDays[i].checked){
                    churchOpenDaysChecked=true;
                    break;
                }               
    
            }
            if(churchOpenDaysChecked == false){
                churchOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
                churchOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
                churchOpenDays[0].focus();
                for( i = 0;i < churchOpenDays.length; i++ ){
                    churchOpenDays[i].onclick = function(){
                        churchOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        churchOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
                return false;
            }
        /* END for church checkBox */
        /* for church open Hours time*/
        var outterTime = document.getElementsByClassName("church-time-one");
        var openHourErrorMessage = document.getElementById("open-hour-error-message");
        for(i = 0; i < outterTime.length ; i++){                
            if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                openHourErrorMessage.classList.add("error_msg_box");
                for( i = 0;i < outterTime.length; i++ ){
                        outterTime[i].classList.add("placeholder_color_border");
                        outterTime[i].focus();
                        outterTime[i].onclick = function(){   
                            for( i = 0;i < outterTime.length; i++ ){                         
                                outterTime[i].classList.remove("placeholder_color_border");
                            }    
                            openHourErrorMessage.innerHTML = "";
                            openHourErrorMessage.classList.remove("error_msg_box");
                    }
                }
                return false;
            }
        }
        /* END for church  open Hours time*/
        /* for church pooja timings time*/
        var outterTime = document.getElementsByClassName("church-time-two");
        var openHourErrorMessage = document.getElementById("open-hour-error-message-two");
        for(i = 0; i < outterTime.length ; i++){                
            if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                openHourErrorMessage.innerHTML = "please Fill Atleast One Day pooja Timings";
                openHourErrorMessage.classList.add("error_msg_box");
                for( i = 0;i < outterTime.length; i++ ){
                        outterTime[i].classList.add("placeholder_color_border");
                        outterTime[i].focus();
                        outterTime[i].onclick = function(){   
                            for( i = 0;i < outterTime.length; i++ ){                         
                                outterTime[i].classList.remove("placeholder_color_border");
                            }    
                            openHourErrorMessage.innerHTML = "";
                            openHourErrorMessage.classList.remove("error_msg_box");
                    }
                }
                return false;
            }
        }
        /* END for church  pooja timings time*/
        /*  for church Description */
            var churchDescription = document.getElementById("church-description");
            var churchDescriptionValue = churchDescription.value.trim();
            if(churchDescriptionValue == null || churchDescriptionValue == "" || churchDescriptionValue.length < 3){
                churchDescription.placeholder = "please Enter Atleast Three Characters";
                churchDescription.value = "";
                churchDescription.classList.add("placeholder_color_border");
                churchDescription.focus();
                churchDescription.onclick = function(){
                    churchDescription.classList.remove("placeholder_color_border");
                    churchDescription.value = churchDescriptionValue;
                }
                churchDescription.onkeydown = function(){
                    churchDescription.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
        /* END for church Description */
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 7){
            /*mosque title*/
            var mosqueTitle = document.getElementById("mosque-title");
            var mosqueTitleValue = mosqueTitle.value.trim();
            if(mosqueTitleValue == null || mosqueTitleValue == ""){
                mosqueTitle.placeholder = "Please Fill This Field";
                mosqueTitle.classList.add("placeholder_color_border");
                mosqueTitle.focus();
                mosqueTitle.onclick = function(){
                    mosqueTitle.classList.remove("placeholder_color_border");
                }
                mosqueTitle.onkeydown = function(){
                    mosqueTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(mosqueTitleValue.length < 4){
                mosqueTitle.placeholder = "Please Enter Atleast Four Characters";
                mosqueTitle.classList.add("placeholder_color_border");
                mosqueTitle.value = "";
                mosqueTitle.focus();
                mosqueTitle.onclick = function(){
                    mosqueTitle.classList.remove("placeholder_color_border");
                    mosqueTitle.value = mosqueTitleValue;
                }
                mosqueTitle.onkeydown = function(){
                    mosqueTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END mosque title*/
             /* for mosque images*/
             var mosqueImageFile = document.getElementById("mosque-image-file");
             var mosqueImageFileValue = mosqueImageFile.value;
             var mosqueImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
             if(!mosqueImageFileValue.match(mosqueImageRegex)){
                mosqueImageFile.classList.add("placeholder_color_border", "image-files");
                mosqueImageFile.title = "Please select correct extensions";
                mosqueImageFile.focus();
                mosqueImageFile.onclick = function(){
                    mosqueImageFile.classList.remove("placeholder_color_border", "image-files");
                 }
                 return false;
             }
             var mosqueImageFileSize = mosqueImageFile.files[0].size;
             if( (mosqueImageFileSize /1024 /1024) > 1){
                mosqueImageFile.classList.add("placeholder_color_border", "image-files-one");
                 mosqueImageFile.title = "Your File Should Be less Than 1 MB";
                 mosqueImageFile.focus();
                 mosqueImageFile.onclick = function(){
                     mosqueImageFile.classList.remove("placeholder_color_border", "image-files-one");
                 }
                 return false;
            }
            var mosqueImageFileLength = mosqueImageFile.files.length;
            if (mosqueImageFileLength > 3){
                 mosqueImageFile.classList.add("placeholder_color_border", "image-files-two");
                 mosqueImageFile.title = "Please Upload only three images";
                 mosqueImageFile.focus();
                 mosqueImageFile.onclick = function(){
                     mosqueImageFile.classList.remove("placeholder_color_border", "image-files-two");
                 }
                
                 return false;
            }
     
             /* END mosque images*/
             /* for mosque url*/                          
             var mosqueUrl = document.getElementById("mosque-url");               
             var mosqueUrlvalue = mosqueUrl.value.trim();               
             var mosqueUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             var mosqueUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
             
             
             if(mosqueUrlvalue =="" || mosqueUrlvalue == null ){
                mosqueUrl.placeholder = "Please Flll this Field";
                mosqueUrl.classList.add("placeholder_color_border");
                mosqueUrl.focus();
                mosqueUrl.onclick = function(){
                    mosqueUrl.classList.remove("placeholder_color_border");
                 }
                 mosqueUrl.onkeydown = function(){
                    mosqueUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }else if(!mosqueUrlvalue.match(mosqueUrlRegex1)){
                 mosqueUrl.placeholder = "Please Enter www.";
                 mosqueUrl.value = "";
                 mosqueUrl.classList.add("placeholder_color_border");
                 mosqueUrl.focus();
                 mosqueUrl.onclick = function(){
                     mosqueUrl.classList.remove("placeholder_color_border");
                     mosqueUrl.value = mosqueUrlvalue;
                 }
                 mosqueUrl.onkeydown = function(){
                    mosqueUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }if(!mosqueUrlvalue.match(mosqueUrlRegex2)){
                 mosqueUrl.placeholder = "Please Enter http or https correctly";
                 mosqueUrl.value = "";
                 mosqueUrl.classList.add("placeholder_color_border");
                 mosqueUrl.focus();
                 mosqueUrl.onclick = function(){
                     mosqueUrl.classList.remove("placeholder_color_border");
                     mosqueUrl.value = mosqueUrlvalue;
                 }
                 mosqueUrl.onkeydown = function(){
                     mosqueUrl.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }
         /* END mosque url*/
         
         /*  mosque location*/
         /* for mosque  location*/
         var mosqueLocation = document.getElementById("mosque-location");
         var mosqueLocationValue = mosqueLocation.value.trim();
         var mosqueLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var mosqueLocationRegex = /([a-zA-Z0-9-. ]+)?/;
         if(!mosqueLocationValue.match(mosqueLocationRegex) || mosqueLocationValue.match(mosqueLocationRegex1)){
             mosqueLocation.placeholder = "please Enter Correct Location";
             mosqueLocation.value = "";
             mosqueLocation.classList.add("placeholder_color_border");
             mosqueLocation.focus();
             mosqueLocation.onclick = function(){
                 mosqueLocation.classList.remove("placeholder_color_border");
                 mosqueLocation.value = mosqueLocationValue;
             }
             mosqueLocation.onkeydown = function(){
                 mosqueLocation.classList.remove("placeholder_color_border");
                 
             }
             return false;
    
    
         }
         /* END for mosque  location*/
         /* for mosque Street*/
         var mosqueStreet = document.getElementById("mosque-street");
         var mosqueStreetValue = mosqueStreet.value.trim();
         var mosqueStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
         var mosqueStreetRegex = /([a-zA-Z0-9 .-]+)?/;
         if(!mosqueStreetValue.match(mosqueStreetRegex) || mosqueStreetValue.match(mosqueStreetRegex1)){
             mosqueStreet.placeholder = "please Enter Correct Street";
             mosqueStreet.value = "";
             mosqueStreet.classList.add("placeholder_color_border");
             mosqueStreet.focus();
             mosqueStreet.onclick = function(){
                 mosqueStreet.classList.remove("placeholder_color_border");
                 mosqueStreet.value = mosqueStreetValue;
             }
             mosqueStreet.onkeydown = function(){
                 mosqueStreet.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for mosque Street*/
         /* for mosque State and city*/        
    
         /* END for mosque State and city*/
         /* for mosque Zip Code*/
         var mosqueZipCode = document.getElementById("mosque-zip");
         var mosqueZipCodeValue = mosqueZipCode.value.trim();
         var mosqueZipCodeRegEx = /(^(631)+\d{2}$)/;
         if(mosqueZipCodeValue == null || mosqueZipCodeValue == "" || !mosqueZipCodeValue.match(mosqueZipCodeRegEx)){
             mosqueZipCode.placeholder = "please Enter Correct Zip Code";
             mosqueZipCode.value = "";
             mosqueZipCode.classList.add("placeholder_color_border");
             mosqueZipCode.focus();
             mosqueZipCode.onclick = function(){
                 mosqueZipCode.classList.remove("placeholder_color_border");
                 mosqueZipCode.value = mosqueZipCodeValue;
             }
             mosqueZipCode.onkeydown = function(){
                 mosqueZipCode.classList.remove("placeholder_color_border");
                 
             }
             return false;
         }
         /* END for mosque Zip Code*/
         
        /*  for mosque checkBox */
            var mosqueOpenDays = document.getElementsByClassName("mosque-open-days");
            var mosqueOpenDaysChecked = false;
            var mosqueOpenDaysCheckedBoxErrorMessage = document.getElementById("mosqueCheckBoxErrorMessage");
            for( i = 0;i < mosqueOpenDays.length; i++ ){
    
                if(mosqueOpenDays[i].checked){
                    mosqueOpenDaysChecked=true;
                    break;
                }               
    
            }
            if(mosqueOpenDaysChecked == false){
                mosqueOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
                mosqueOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
                mosqueOpenDays[0].focus();
                for( i = 0;i < mosqueOpenDays.length; i++ ){
                    mosqueOpenDays[i].onclick = function(){
                        mosqueOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        mosqueOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
                return false;
            }
        /* END for mosque checkBox */
        /* for mosque open Hours time*/
        var outterTime = document.getElementsByClassName("mosque-time-one");
        var openHourErrorMessage = document.getElementById("open-hour-error-message");
        for(i = 0; i < outterTime.length ; i++){                
            if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                openHourErrorMessage.classList.add("error_msg_box");
                for( i = 0;i < outterTime.length; i++ ){
                        outterTime[i].classList.add("placeholder_color_border");
                        outterTime[i].focus();
                        outterTime[i].onclick = function(){   
                            for( i = 0;i < outterTime.length; i++ ){                         
                                outterTime[i].classList.remove("placeholder_color_border");
                            }    
                            openHourErrorMessage.innerHTML = "";
                            openHourErrorMessage.classList.remove("error_msg_box");
                    }
                }
                return false;
            }
        }
        /* END for mosque  open Hours time*/
        /* for mosque pooja timings time*/
        var outterTime = document.getElementsByClassName("mosque-time-two");
        var openHourErrorMessage = document.getElementById("open-hour-error-message-two");
        for(i = 0; i < outterTime.length ; i++){                
            if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                openHourErrorMessage.innerHTML = "please Fill Atleast One Day pooja Timings";
                openHourErrorMessage.classList.add("error_msg_box");
                for( i = 0;i < outterTime.length; i++ ){
                        outterTime[i].classList.add("placeholder_color_border");
                        outterTime[i].focus();
                        outterTime[i].onclick = function(){   
                            for( i = 0;i < outterTime.length; i++ ){                         
                                outterTime[i].classList.remove("placeholder_color_border");
                            }    
                            openHourErrorMessage.innerHTML = "";
                            openHourErrorMessage.classList.remove("error_msg_box");
                    }
                }
                return false;
            }
        }
        /* END for mosque  pooja timings time*/
        /*  for mosque Description */
            var mosqueDescription = document.getElementById("mosque-description");
            var mosqueDescriptionValue = mosqueDescription.value.trim();
            if(mosqueDescriptionValue == null || mosqueDescriptionValue == "" || mosqueDescriptionValue.length < 3){
                mosqueDescription.placeholder = "please Enter Atleast Three Characters";
                mosqueDescription.value = "";
                mosqueDescription.classList.add("placeholder_color_border");
                mosqueDescription.focus();
                mosqueDescription.onclick = function(){
                    mosqueDescription.classList.remove("placeholder_color_border");
                    mosqueDescription.value = mosqueDescriptionValue;
                }
                mosqueDescription.onkeydown = function(){
                    mosqueDescription.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
        /* END for mosque Description */
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 8){
             /*others title*/
             var othersTitle = document.getElementById("others-title");
             var othersTitleValue = othersTitle.value.trim();
             if(othersTitleValue == null || othersTitleValue == ""){
                 othersTitle.placeholder = "Please Fill This Field";
                 othersTitle.classList.add("placeholder_color_border");
                 othersTitle.focus();
                 othersTitle.onclick = function(){
                     othersTitle.classList.remove("placeholder_color_border");
                 }
                 othersTitle.onkeydown = function(){
                     othersTitle.classList.remove("placeholder_color_border");
                 }
                 return false;
             }else if(othersTitleValue.length < 4){
                 othersTitle.placeholder = "Please Enter Atleast Four Characters";
                 othersTitle.classList.add("placeholder_color_border");
                 othersTitle.value = "";
                 othersTitle.focus();
                 othersTitle.onclick = function(){
                     othersTitle.classList.remove("placeholder_color_border");
                     othersTitle.value = othersTitleValue;
                 }
                 othersTitle.onkeydown = function(){
                     othersTitle.classList.remove("placeholder_color_border");
                    
                 }
                 return false;
             }
             /*END others title*/
              /* for others images*/
              var othersImageFile = document.getElementById("others-image-file");
              var othersImageFileValue = othersImageFile.value;
              var othersImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
              if(!othersImageFileValue.match(othersImageRegex)){
                 othersImageFile.classList.add("placeholder_color_border", "image-files");
                 othersImageFile.title = "Please select correct extensions";
                 othersImageFile.focus();
                 othersImageFile.onclick = function(){
                     othersImageFile.classList.remove("placeholder_color_border", "image-files");
                  }
                  return false;
              }
              var othersImageFileSize = othersImageFile.files[0].size;
              if( (othersImageFileSize /1024 /1024) > 1){
                 othersImageFile.classList.add("placeholder_color_border", "image-files-one");
                  othersImageFile.title = "Your File Should Be less Than 1 MB";
                  othersImageFile.focus();
                  othersImageFile.onclick = function(){
                      othersImageFile.classList.remove("placeholder_color_border", "image-files-one");
                  }
                  return false;
             }
             var othersImageFileLength = othersImageFile.files.length;
             if (othersImageFileLength > 3){
                  othersImageFile.classList.add("placeholder_color_border", "image-files-two");
                  othersImageFile.title = "Please Upload only three images";
                  othersImageFile.focus();
                  othersImageFile.onclick = function(){
                      othersImageFile.classList.remove("placeholder_color_border", "image-files-two");
                  }
                 
                  return false;
             }
      
              /* END others images*/
              /* for others url*/                          
              var othersUrl = document.getElementById("others-url");               
              var othersUrlvalue = othersUrl.value.trim();               
              var othersUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
              var othersUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
              
              
              if(othersUrlvalue =="" || othersUrlvalue == null ){
                 othersUrl.placeholder = "Please Flll this Field";
                 othersUrl.classList.add("placeholder_color_border");
                 othersUrl.focus();
                 othersUrl.onclick = function(){
                     othersUrl.classList.remove("placeholder_color_border");
                  }
                  othersUrl.onkeydown = function(){
                     othersUrl.classList.remove("placeholder_color_border");
                      
                  }
                  return false;
              }else if(!othersUrlvalue.match(othersUrlRegex1)){
                  othersUrl.placeholder = "Please Enter www.";
                  othersUrl.value = "";
                  othersUrl.classList.add("placeholder_color_border");
                  othersUrl.focus();
                  othersUrl.onclick = function(){
                      othersUrl.classList.remove("placeholder_color_border");
                      othersUrl.value = othersUrlvalue;
                  }
                  othersUrl.onkeydown = function(){
                     othersUrl.classList.remove("placeholder_color_border");
                      
                  }
                  return false;
              }if(!othersUrlvalue.match(othersUrlRegex2)){
                  othersUrl.placeholder = "Please Enter http or https correctly";
                  othersUrl.value = "";
                  othersUrl.classList.add("placeholder_color_border");
                  othersUrl.focus();
                  othersUrl.onclick = function(){
                      othersUrl.classList.remove("placeholder_color_border");
                      othersUrl.value = othersUrlvalue;
                  }
                  othersUrl.onkeydown = function(){
                      othersUrl.classList.remove("placeholder_color_border");
                      
                  }
                  return false;
              }
          /* END others url*/
          
          /*  others location*/
          /* for others  location*/
          var othersLocation = document.getElementById("others-location");
          var othersLocationValue = othersLocation.value.trim();
          var othersLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
          var othersLocationRegex = /([a-zA-Z0-9-. ]+)?/;
          if(!othersLocationValue.match(othersLocationRegex) || othersLocationValue.match(othersLocationRegex1)){
              othersLocation.placeholder = "please Enter Correct Location";
              othersLocation.value = "";
              othersLocation.classList.add("placeholder_color_border");
              othersLocation.focus();
              othersLocation.onclick = function(){
                  othersLocation.classList.remove("placeholder_color_border");
                  othersLocation.value = othersLocationValue;
              }
              othersLocation.onkeydown = function(){
                  othersLocation.classList.remove("placeholder_color_border");
                  
              }
              return false;
     
     
          }
          /* END for others  location*/
          /* for others Street*/
          var othersStreet = document.getElementById("others-street");
          var othersStreetValue = othersStreet.value.trim();
          var othersStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
          var othersStreetRegex = /([a-zA-Z0-9 .-]+)?/;
          if(!othersStreetValue.match(othersStreetRegex) || othersStreetValue.match(othersStreetRegex1)){
              othersStreet.placeholder = "please Enter Correct Street";
              othersStreet.value = "";
              othersStreet.classList.add("placeholder_color_border");
              othersStreet.focus();
              othersStreet.onclick = function(){
                  othersStreet.classList.remove("placeholder_color_border");
                  othersStreet.value = othersStreetValue;
              }
              othersStreet.onkeydown = function(){
                  othersStreet.classList.remove("placeholder_color_border");
                  
              }
              return false;
          }
          /* END for others Street*/
          /* for others State and city*/        
     
          /* END for others State and city*/
          /* for others Zip Code*/
          var othersZipCode = document.getElementById("others-zip");
          var othersZipCodeValue = othersZipCode.value.trim();
          var othersZipCodeRegEx = /(^(631)+\d{2}$)/;
          if(othersZipCodeValue == null || othersZipCodeValue == "" || !othersZipCodeValue.match(othersZipCodeRegEx)){
              othersZipCode.placeholder = "please Enter Correct Zip Code";
              othersZipCode.value = "";
              othersZipCode.classList.add("placeholder_color_border");
              othersZipCode.focus();
              othersZipCode.onclick = function(){
                  othersZipCode.classList.remove("placeholder_color_border");
                  othersZipCode.value = othersZipCodeValue;
              }
              othersZipCode.onkeydown = function(){
                  othersZipCode.classList.remove("placeholder_color_border");
                  
              }
              return false;
          }
          /* END for others Zip Code*/
          
         /*  for others checkBox */
             var othersOpenDays = document.getElementsByClassName("others-open-days");
             var othersOpenDaysChecked = false;
             var othersOpenDaysCheckedBoxErrorMessage = document.getElementById("othersCheckBoxErrorMessage");
             for( i = 0;i < othersOpenDays.length; i++ ){
     
                 if(othersOpenDays[i].checked){
                     othersOpenDaysChecked=true;
                     break;
                 }               
     
             }
             if(othersOpenDaysChecked == false){
                 othersOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
                 othersOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
                 othersOpenDays[0].focus();
                 for( i = 0;i < othersOpenDays.length; i++ ){
                    othersOpenDays[i].onclick = function(){
                        othersOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        othersOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
                 return false;
             }
         /* END for others checkBox */
            /* for others open Hours time*/
            var outterTime = document.getElementsByClassName("others-time-one");
            var openHourErrorMessage = document.getElementById("open-hour-error-message");
            for(i = 0; i < outterTime.length ; i++){                
                if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                    openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                    openHourErrorMessage.classList.add("error_msg_box");
                    for( i = 0;i < outterTime.length; i++ ){
                            outterTime[i].classList.add("placeholder_color_border");
                            outterTime[i].focus();
                            outterTime[i].onclick = function(){   
                                for( i = 0;i < outterTime.length; i++ ){                         
                                    outterTime[i].classList.remove("placeholder_color_border");
                                }    
                                openHourErrorMessage.innerHTML = "";
                                openHourErrorMessage.classList.remove("error_msg_box");
                        }
                    }
                    return false;
                }
            }
            /* END for others  open Hours time*/
            /* for others pooja timings time*/
            var outterTime = document.getElementsByClassName("others-time-two");
            var openHourErrorMessage = document.getElementById("open-hour-error-message-two");
            for(i = 0; i < outterTime.length ; i++){                
                if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                    openHourErrorMessage.innerHTML = "please Fill Atleast One Day pooja Timings";
                    openHourErrorMessage.classList.add("error_msg_box");
                    for( i = 0;i < outterTime.length; i++ ){
                            outterTime[i].classList.add("placeholder_color_border");
                            outterTime[i].focus();
                            outterTime[i].onclick = function(){   
                                for( i = 0;i < outterTime.length; i++ ){                         
                                    outterTime[i].classList.remove("placeholder_color_border");
                                }    
                                openHourErrorMessage.innerHTML = "";
                                openHourErrorMessage.classList.remove("error_msg_box");
                        }
                    }
                    return false;
                }
            }
            /* END for others  pooja timings time*/
         /*  for others Description */
             var othersDescription = document.getElementById("others-description");
             var othersDescriptionValue = othersDescription.value.trim();
             if(othersDescriptionValue == null || othersDescriptionValue == "" || othersDescriptionValue.length < 3){
                 othersDescription.placeholder = "please Enter Atleast Three Characters";
                 othersDescription.value = "";
                 othersDescription.classList.add("placeholder_color_border");
                 othersDescription.focus();
                 othersDescription.onclick = function(){
                     othersDescription.classList.remove("placeholder_color_border");
                     othersDescription.value = othersDescriptionValue;
                 }
                 othersDescription.onkeydown = function(){
                     othersDescription.classList.remove("placeholder_color_border");
                     
                 }
                 return false;
             }
         /* END for others Description */
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 9 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 10 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 11 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 12 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 13 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 14 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 15 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 16 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 17 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 18 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 19 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 20){
            /*eight title*/
            var eightTitle = document.getElementById("eight-title");
            var eightTitleValue = eightTitle.value.trim();
            if(eightTitleValue == null || eightTitleValue == ""){
                eightTitle.placeholder = "Please Fill This Field";
                eightTitle.classList.add("placeholder_color_border");
                eightTitle.focus();
                eightTitle.onclick = function(){
                    eightTitle.classList.remove("placeholder_color_border");
                }
                eightTitle.onkeydown = function(){
                    eightTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(eightTitleValue.length < 4){
                eightTitle.placeholder = "Please Enter Atleast Four Characters";
                eightTitle.classList.add("placeholder_color_border");
                eightTitle.value = "";
                eightTitle.focus();
                eightTitle.onclick = function(){
                    eightTitle.classList.remove("placeholder_color_border");
                    eightTitle.value = eightTitleValue;
                }
                eightTitle.onkeydown = function(){
                    eightTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END eight title*/
            /* for eight images*/
            var eightImageFile = document.getElementById("eight-image-file");
            var eightImageFileValue = eightImageFile.value;
            var eightImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
            if(!eightImageFileValue.match(eightImageRegex)){
               eightImageFile.classList.add("placeholder_color_border", "image-files");
               eightImageFile.title = "Please select correct extensions";
               eightImageFile.focus();
               eightImageFile.onclick = function(){
                   eightImageFile.classList.remove("placeholder_color_border", "image-files");
                }
                return false;
            }
            var eightImageFileSize = eightImageFile.files[0].size;
            if( (eightImageFileSize /1024 /1024) > 1){
               eightImageFile.classList.add("placeholder_color_border", "image-files-one");
                eightImageFile.title = "Your File Should Be less Than 1 MB";
                eightImageFile.focus();
                eightImageFile.onclick = function(){
                    eightImageFile.classList.remove("placeholder_color_border", "image-files-one");
                }
                return false;
           }
           var eightImageFileLength = eightImageFile.files.length;
           if (eightImageFileLength > 3){
                eightImageFile.classList.add("placeholder_color_border", "image-files-two");
                eightImageFile.title = "Please Upload only three images";
                eightImageFile.focus();
                eightImageFile.onclick = function(){
                    eightImageFile.classList.remove("placeholder_color_border", "image-files-two");
                }
               
                return false;
           }
    
            /* END eight images*/
            /* for eight url*/                          
            var eightUrl = document.getElementById("eight-url");               
            var eightUrlvalue = eightUrl.value.trim();               
            var eightUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            var eightUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            
            
            if(eightUrlvalue =="" || eightUrlvalue == null ){
               eightUrl.placeholder = "Please Flll this Field";
               eightUrl.classList.add("placeholder_color_border");
               eightUrl.focus();
               eightUrl.onclick = function(){
                   eightUrl.classList.remove("placeholder_color_border");
                }
                eightUrl.onkeydown = function(){
                   eightUrl.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }else if(!eightUrlvalue.match(eightUrlRegex1)){
                eightUrl.placeholder = "Please Enter www.";
                eightUrl.value = "";
                eightUrl.classList.add("placeholder_color_border");
                eightUrl.focus();
                eightUrl.onclick = function(){
                    eightUrl.classList.remove("placeholder_color_border");
                    eightUrl.value = eightUrlvalue;
                }
                eightUrl.onkeydown = function(){
                   eightUrl.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }if(!eightUrlvalue.match(eightUrlRegex2)){
                eightUrl.placeholder = "Please Enter http or https correctly";
                eightUrl.value = "";
                eightUrl.classList.add("placeholder_color_border");
                eightUrl.focus();
                eightUrl.onclick = function(){
                    eightUrl.classList.remove("placeholder_color_border");
                    eightUrl.value = eightUrlvalue;
                }
                eightUrl.onkeydown = function(){
                    eightUrl.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
        /* END eight url*/
        
         /* eight email and mobile*/
         var eightEmail = document.getElementById("eight-email");
         var eightMobile = document.getElementById("eight-mobile");
         var eightEmailValue = eightEmail.value.trim();
         var eightMobileValue = eightMobile.value.trim();
         var eightEmailValueLength = eightEmailValue.length;
         var eightMobileValueLength = eightMobileValue.length;
         var eightEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
         var eightmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
    
         if(!eightEmailValueLength && !eightMobileValueLength){
            eightEmail.placeholder = "Please Fill Email Address Or Mobile Number";
            eightMobile.placeholder = "Please Fill Email Address Or Mobile Number";
            eightEmail.classList.add("placeholder_color_border");
            eightMobile.classList.add("placeholder_color_border");
            eightEmail.focus();
            eightMobile.focus();
            eightEmail.onclick = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            eightEmail.onkeydown = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            eightMobile.onclick = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            eightMobile.onkeydown = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            return false;
         }else if(!eightEmailValue.match(eightEmailRegEx) && !eightMobileValue.match(eightmobileRegEx)){
            
            eightEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
            eightMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
            eightEmail.classList.add("placeholder_color_border");
            eightMobile.classList.add("placeholder_color_border");
            eightEmail.value = "";
            eightMobile.value = "";
            eightEmail.focus();
            eightMobile.focus();
            eightEmail.onclick = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
                eightEmail.value = eightEmailValue;
                eightMobile.value = eightMobileValue;
            }
            eightEmail.onkeydown = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            eightMobile.onclick = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
                eightEmail.value = eightEmailValue;
                eightMobile.value = eightMobileValue;
            }
            eightMobile.onkeydown = function(){
                eightEmail.classList.remove("placeholder_color_border");
                eightMobile.classList.remove("placeholder_color_border");
            }
            
            return false;
         }
         
     /* END eight email and mobile*/
        
        /*  eight location*/
        /* for eight  location*/
        var eightLocation = document.getElementById("eight-location");
        var eightLocationValue = eightLocation.value.trim();
        var eightLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var eightLocationRegex = /([a-zA-Z0-9-. ]+)?/;
        if(!eightLocationValue.match(eightLocationRegex) || eightLocationValue.match(eightLocationRegex1)){
            eightLocation.placeholder = "please Enter Correct Location";
            eightLocation.value = "";
            eightLocation.classList.add("placeholder_color_border");
            eightLocation.focus();
            eightLocation.onclick = function(){
                eightLocation.classList.remove("placeholder_color_border");
                eightLocation.value = eightLocationValue;
            }
            eightLocation.onkeydown = function(){
                eightLocation.classList.remove("placeholder_color_border");
                
            }
            return false;
    
    
        }
        /* END for eight  location*/
        /* for eight Street*/
        var eightStreet = document.getElementById("eight-street");
        var eightStreetValue = eightStreet.value.trim();
        var eightStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var eightStreetRegex = /([a-zA-Z0-9 .-]+)?/;
        if(!eightStreetValue.match(eightStreetRegex) || eightStreetValue.match(eightStreetRegex1)){
            eightStreet.placeholder = "please Enter Correct Street";
            eightStreet.value = "";
            eightStreet.classList.add("placeholder_color_border");
            eightStreet.focus();
            eightStreet.onclick = function(){
                eightStreet.classList.remove("placeholder_color_border");
                eightStreet.value = eightStreetValue;
            }
            eightStreet.onkeydown = function(){
                eightStreet.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for eight Street*/
        /* for eight State and city*/        
    
        /* END for eight State and city*/
        /* for eight Zip Code*/
        var eightZipCode = document.getElementById("eight-zip");
        var eightZipCodeValue = eightZipCode.value.trim();
        var eightZipCodeRegEx = /(^(631)+\d{2}$)/;
        if(eightZipCodeValue == null || eightZipCodeValue == "" || !eightZipCodeValue.match(eightZipCodeRegEx)){
            eightZipCode.placeholder = "please Enter Correct Zip Code";
            eightZipCode.value = "";
            eightZipCode.classList.add("placeholder_color_border");
            eightZipCode.focus();
            eightZipCode.onclick = function(){
                eightZipCode.classList.remove("placeholder_color_border");
                eightZipCode.value = eightZipCodeValue;
            }
            eightZipCode.onkeydown = function(){
                eightZipCode.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for eight Zip Code*/
        
       /*  for eight checkBox */
           var eightOpenDays = document.getElementsByClassName("eight-open-days");
           var eightOpenDaysChecked = false;
           var eightOpenDaysCheckedBoxErrorMessage = document.getElementById("eightCheckBoxErrorMessage");
           for( i = 0;i < eightOpenDays.length; i++ ){
    
               if(eightOpenDays[i].checked){
                   eightOpenDaysChecked=true;
                   break;
               }               
    
           }
           if(eightOpenDaysChecked == false){
               eightOpenDaysCheckedBoxErrorMessage.innerHTML = "please check atleast one check box";
               eightOpenDaysCheckedBoxErrorMessage.classList.add("error_msg_box");
               eightOpenDays[0].focus();
                for( i = 0;i < eightOpenDays.length; i++ ){
                    eightOpenDays[i].onclick = function(){
                        eightOpenDaysCheckedBoxErrorMessage.classList.remove("error_msg_box");
                        eightOpenDaysCheckedBoxErrorMessage.innerHTML = "";
                    }
                }    
               return false;
           }
       /* END for eight checkBox */
        /* for eight open Hours time*/
            var outterTime = document.getElementsByClassName("eight-time-one");
            var openHourErrorMessage = document.getElementById("open-hour-error-message");
            for(i = 0; i < outterTime.length ; i++){                
                if( (outterTime[0].value == "" || outterTime[1].value == "") && (outterTime[2].value == "" || outterTime[3].value == "") && (outterTime[4].value == "" || outterTime[5].value == "") && (outterTime[6].value == "" || outterTime[7].value == "") && (outterTime[8].value == "" || outterTime[9].value == "") && (outterTime[10].value == "" || outterTime[11].value == "") && (outterTime[12].value == "" || outterTime[13].value == "") ){
                    openHourErrorMessage.innerHTML = "please Fill Atleast One Day Open Hours";
                    openHourErrorMessage.classList.add("error_msg_box");
                    for( i = 0;i < outterTime.length; i++ ){
                            outterTime[i].classList.add("placeholder_color_border");
                            outterTime[i].focus();
                            outterTime[i].onclick = function(){   
                                for( i = 0;i < outterTime.length; i++ ){                         
                                    outterTime[i].classList.remove("placeholder_color_border");
                                }    
                                openHourErrorMessage.innerHTML = "";
                                openHourErrorMessage.classList.remove("error_msg_box");
                        }
                    }
                    return false;
                }
            }
            /* END for eight  open Hours time*/
            
       /*  for eight Description */
           var eightDescription = document.getElementById("eight-description");
           var eightDescriptionValue = eightDescription.value.trim();
           if(eightDescriptionValue == null || eightDescriptionValue == "" || eightDescriptionValue.length < 3){
               eightDescription.placeholder = "please Enter Atleast Three Characters";
               eightDescription.value = "";
               eightDescription.classList.add("placeholder_color_border");
               eightDescription.focus();
               eightDescription.onclick = function(){
                   eightDescription.classList.remove("placeholder_color_border");
                   eightDescription.value = eightDescriptionValue;
               }
               eightDescription.onkeydown = function(){
                   eightDescription.classList.remove("placeholder_color_border");
                   
               }
               return false;
           }
       /* END for eight Description */
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 21 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 22 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 23 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 24 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 25){
            /*nine title*/
            var nineTitle = document.getElementById("nine-title");
            var nineTitleValue = nineTitle.value.trim();
            if(nineTitleValue == null || nineTitleValue == ""){
                nineTitle.placeholder = "Please Fill This Field";
                nineTitle.classList.add("placeholder_color_border");
                nineTitle.focus();
                nineTitle.onclick = function(){
                    nineTitle.classList.remove("placeholder_color_border");
                }
                nineTitle.onkeydown = function(){
                    nineTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(nineTitleValue.length < 4){
                nineTitle.placeholder = "Please Enter Atleast Four Characters";
                nineTitle.classList.add("placeholder_color_border");
                nineTitle.value = "";
                nineTitle.focus();
                nineTitle.onclick = function(){
                    nineTitle.classList.remove("placeholder_color_border");
                    nineTitle.value = nineTitleValue;
                }
                nineTitle.onkeydown = function(){
                    nineTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END nine title*/
            /* for nine images*/
            var nineImageFile = document.getElementById("nine-image-file");
            var nineImageFileValue = nineImageFile.value;
            var nineImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;                
            if(!nineImageFileValue.match(nineImageRegex)){
               nineImageFile.classList.add("placeholder_color_border", "image-files");
               nineImageFile.title = "Please select correct extensions";
               nineImageFile.focus();
               nineImageFile.onclick = function(){
                   nineImageFile.classList.remove("placeholder_color_border", "image-files");
                }
                return false;
            }
            var nineImageFileSize = nineImageFile.files[0].size;
            if( (nineImageFileSize /1024 /1024) > 1){
               nineImageFile.classList.add("placeholder_color_border", "image-files-one");
                nineImageFile.title = "Your File Should Be less Than 1 MB";
                nineImageFile.focus();
                nineImageFile.onclick = function(){
                    nineImageFile.classList.remove("placeholder_color_border", "image-files-one");
                }
                return false;
           }
           var nineImageFileLength = nineImageFile.files.length;
           if (nineImageFileLength > 3){
                nineImageFile.classList.add("placeholder_color_border", "image-files-two");
                nineImageFile.title = "Please Upload only three images";
                nineImageFile.focus();
                nineImageFile.onclick = function(){
                    nineImageFile.classList.remove("placeholder_color_border", "image-files-two");
                }
               
                return false;
           }
    
            /* END nine images*/
           /* nine directors name*/
            var nineDirectors = document.getElementById("nine-director");
            var nineDirectorsValue = nineDirectors.value.trim();
            var nineRegExForName = /^([a-zA-Z ']){2}/;
            if(nineDirectorsValue == null || nineDirectorsValue == ""){
                nineDirectors.placeholder = "please Enter Directors Name";
                nineDirectors.classList.add("placeholder_color_border");
                nineDirectors.focus();
                nineDirectors.onclick = function(){
                    nineDirectors.classList.remove("placeholder_color_border");
                }
                nineDirectors.onkeydown = function(){
                    nineDirectors.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(!nineDirectorsValue.match(nineRegExForName)){
                nineDirectors.placeholder = "Please Enter Director name Should Be in Atleast Two Characters and Not Use Numbers";
                nineDirectors.classList.add("placeholder_color_border");
                nineDirectors.value = "";
                nineDirectors.focus();
                nineDirectors.onclick = function(){
                    nineDirectors.classList.remove("placeholder_color_border");
                    nineDirectors.value = nineDirectorsValue;
                }
                nineDirectors.onkeydown = function(){
                    nineDirectors.classList.remove("placeholder_color_border");
                }
                return false;
            }
           /* END nine directors name*/
           /* nine producer name*/
           var nineProducer = document.getElementById("nine-producer");
           var nineProducerValue = nineProducer.value.trim(); 
           if(nineProducerValue == null || nineProducerValue == ""){
               nineProducer.placeholder ="please Enter Producer Name";
               nineProducer.classList.add("placeholder_color_border");
               nineProducer.focus();
               nineProducer.onclick = function(){
                   nineProducer.classList.remove("placeholder_color_border");
                   
               }
               nineProducer.onkeydown = function(){
                   nineProducer.classList.remove("placeholder_color_border");
               }
               return false;
           }else if(!nineProducerValue.match(nineRegExForName)){
               nineProducer.placeholder = "Please Enter producer name Should Be in Atleast Two Characters and Not Use Numbers";
               nineProducer.classList.add("placeholder_color_border");           
               nineProducer.value = "";
               nineProducer.focus();
               nineProducer.onclick = function(){
                   nineProducer.classList.remove("placeholder_color_border");
                   nineProducer.value = nineProducerValue;
               }
               nineProducer.onkeydown = function(){
                    nineProducer.classList.remove("placeholder_color_border");
                }
               return false;
           }
          /* END nine producer name*/
           /* nine music Director name*/
           var nineMusicDirector = document.getElementById("nine-music");
           var nineMusicDirectorValue = nineMusicDirector.value.trim(); 
           if(nineMusicDirectorValue == null || nineMusicDirectorValue == ""){
               nineMusicDirector.placeholder ="please Enter Music Director Name";
               nineMusicDirector.classList.add("placeholder_color_border");
               nineMusicDirector.focus();
               nineMusicDirector.onclick = function(){
                   nineMusicDirector.classList.remove("placeholder_color_border");
                   
               }
               nineMusicDirector.onkeydown = function(){
                   nineMusicDirector.classList.remove("placeholder_color_border");
               }
               return false;
           }else if(!nineMusicDirectorValue.match(nineRegExForName)){
               nineMusicDirector.placeholder = "Please Enter music Director name Should Be in Atleast Two Characters and Not Use Numbers";
               nineMusicDirector.classList.add("placeholder_color_border");           
               nineMusicDirector.value = "";
               nineMusicDirector.focus();
               nineMusicDirector.onclick = function(){
                   nineMusicDirector.classList.remove("placeholder_color_border");
                   nineMusicDirector.value = nineMusicDirectorValue;
               }
               nineMusicDirector.onkeydown = function(){
                    nineMusicDirector.classList.remove("placeholder_color_border");
                }
               return false;
           }
          /* END nine music Director name*/
          /* nine Theaters list name*/
          var nineTheatersIn = document.getElementById("nine-theaters");
          var nineTheatersInValue = nineTheatersIn.value.trim(); 
          var nineTheatersInRegEx = /([a-zA-Z0-9 -',.]+){2}$/;
          if(nineTheatersInValue == null || nineTheatersInValue == ""){
              nineTheatersIn.placeholder ="please Enter Theaters list";
              nineTheatersIn.classList.add("placeholder_color_border");
              nineTheatersIn.focus();
              nineTheatersIn.onclick = function(){
                  nineTheatersIn.classList.remove("placeholder_color_border");
                  
              }
              nineTheatersIn.onkeydown = function(){
                  nineTheatersIn.classList.remove("placeholder_color_border");
              }
              return false;
          }else if(!nineTheatersInValue.match(nineTheatersInRegEx)){
              nineTheatersIn.placeholder = "Please Enter Theaters list  Should Be in Atleast Two Characters and Not Enter Special Characters";
              nineTheatersIn.classList.add("placeholder_color_border");           
              nineTheatersIn.value = "";
              nineTheatersIn.focus();
              nineTheatersIn.onclick = function(){
                  nineTheatersIn.classList.remove("placeholder_color_border");
                  nineTheatersIn.value = nineTheatersInValue;
              }
              nineTheatersIn.onkeydown = function(){
                   nineTheatersIn.classList.remove("placeholder_color_border");
               }
              return false;
          }
         /* END nine Theaters list name*/
         /* nine cast And Crew name*/
         var nineCastCrew = document.getElementById("nine-castcrew");
         var nineCastCrewValue = nineCastCrew.value.trim(); 
         var nineCastCrewRegEx = /([a-zA-Z0-9 -',.|]+){2}$/;
         if(nineCastCrewValue == null || nineCastCrewValue == ""){
             nineCastCrew.placeholder ="please Enter Cast And crew";
             nineCastCrew.classList.add("placeholder_color_border");
             nineCastCrew.focus();
             nineCastCrew.onclick = function(){
                 nineCastCrew.classList.remove("placeholder_color_border");
                 
             }
             nineCastCrew.onkeydown = function(){
                 nineCastCrew.classList.remove("placeholder_color_border");
             }
             return false;
         }else if(!nineCastCrewValue.match(nineCastCrewRegEx)){
             nineCastCrew.placeholder = "Please Enter Cast And crew Names Should Be in Atleast Two Characters and Not Enter Special Characters";
             nineCastCrew.classList.add("placeholder_color_border");           
             nineCastCrew.value = "";
             nineCastCrew.focus();
             nineCastCrew.onclick = function(){
                 nineCastCrew.classList.remove("placeholder_color_border");
                 nineCastCrew.value = nineCastCrewValue;
             }
             nineCastCrew.onkeydown = function(){
                  nineCastCrew.classList.remove("placeholder_color_border");
              }
             return false;
         }
        /* END nine cast And Crew name*/
        /* nine Release Date*/
        var nineReleaseDate = document.getElementById("nine-releasedate");
        var nineReleaseDateValue = nineReleaseDate.value; 
        var nineReleaseDateErrorMessage = document.getElementById("nine-release-date-error-message");
        if(nineReleaseDateValue == null || nineReleaseDateValue == "" ){
            nineReleaseDateErrorMessage.innerHTML ="please Enter Release Date";
            nineReleaseDateErrorMessage.classList.add("error_msg_box");        
            nineReleaseDate.classList.add("placeholder_color_border");
            nineReleaseDate.focus();
            nineReleaseDate.onclick = function(){
                nineReleaseDate.classList.remove("placeholder_color_border");
                nineReleaseDateErrorMessage.innerHTML ="";
                nineReleaseDateErrorMessage.classList.remove("error_msg_box");  
            }
            return false;
        }
       /* END nine Release Date*/
        /*  nine location*/
        /* for nine  location*/
        var nineLocation = document.getElementById("nine-location");
        var nineLocationValue = nineLocation.value.trim();
        var nineLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var nineLocationRegex = /([a-zA-Z0-9-. ]+)?/;
        if(!nineLocationValue.match(nineLocationRegex) || nineLocationValue.match(nineLocationRegex1)){
            nineLocation.placeholder = "please Enter Correct Location";
            nineLocation.value = "";
            nineLocation.classList.add("placeholder_color_border");
            nineLocation.focus();
            nineLocation.onclick = function(){
                nineLocation.classList.remove("placeholder_color_border");
                nineLocation.value = nineLocationValue;
            }
            nineLocation.onkeydown = function(){
                nineLocation.classList.remove("placeholder_color_border");
                
            }
            return false;
    
            
        }
        /* END for nine  location*/
        /* for nine Street*/
        var nineStreet = document.getElementById("nine-street");
        var nineStreetValue = nineStreet.value.trim();
        var nineStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var nineStreetRegex = /([a-zA-Z0-9 .-]+)?/;
        if(!nineStreetValue.match(nineStreetRegex) || nineStreetValue.match(nineStreetRegex1)){
            nineStreet.placeholder = "please Enter Correct Street";
            nineStreet.value = "";
            nineStreet.classList.add("placeholder_color_border");
            nineStreet.focus();
            nineStreet.onclick = function(){
                nineStreet.classList.remove("placeholder_color_border");
                nineStreet.value = nineStreetValue;
            }
            nineStreet.onkeydown = function(){
                nineStreet.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for nine Street*/
        /* for nine State and city*/        
    
        /* END for nine State and city*/
        /* for nine Zip Code*/
        var nineZipCode = document.getElementById("nine-zip");
        var nineZipCodeValue = nineZipCode.value.trim();
        var nineZipCodeRegEx = /(^(631)+\d{2}$)/;
        if(nineZipCodeValue == null || nineZipCodeValue == "" || !nineZipCodeValue.match(nineZipCodeRegEx)){
            nineZipCode.placeholder = "please Enter Correct Zip Code";
            nineZipCode.value = "";
            nineZipCode.classList.add("placeholder_color_border");
            nineZipCode.focus();
            nineZipCode.onclick = function(){
                nineZipCode.classList.remove("placeholder_color_border");
                nineZipCode.value = nineZipCodeValue;
            }
            nineZipCode.onkeydown = function(){
                nineZipCode.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for nine Zip Code*/
        
       /*  for nine Description */
           var nineDescription = document.getElementById("nine-description");
           var nineDescriptionValue = nineDescription.value.trim();
           if(nineDescriptionValue == null || nineDescriptionValue == "" || nineDescriptionValue.length < 3){
               nineDescription.placeholder = "please Enter Atleast Three Characters";
               nineDescription.value = "";
               nineDescription.classList.add("placeholder_color_border");
               nineDescription.focus();
               nineDescription.onclick = function(){
                   nineDescription.classList.remove("placeholder_color_border");
                   nineDescription.value = nineDescriptionValue;
               }
               nineDescription.onkeydown = function(){
                   nineDescription.classList.remove("placeholder_color_border");
                   
               }
               return false;
           }
       /* END for nine Description */
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 28 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 29){
    
            /*job title*/
            var jobTitle = document.getElementById("job-title");
            var jobTitleValue = jobTitle.value.trim();
            if(jobTitleValue == null || jobTitleValue == ""){
                jobTitle.placeholder = "Please Fill This Field";
                jobTitle.classList.add("placeholder_color_border");
                jobTitle.focus();
                jobTitle.onclick = function(){
                    jobTitle.classList.remove("placeholder_color_border");
                }
                jobTitle.onkeydown = function(){
                    jobTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(jobTitleValue.length < 4){
                jobTitle.placeholder = "Please Enter Atleast Four Characters";
                jobTitle.classList.add("placeholder_color_border");
                jobTitle.value = "";
                jobTitle.focus();
                jobTitle.onclick = function(){
                    jobTitle.classList.remove("placeholder_color_border");
                    jobTitle.value = jobTitleValue;
                }
                jobTitle.onkeydown = function(){
                    jobTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END job title*/
            /* job email and mobile*/
            var jobEmail = document.getElementById("job-email");
            var jobMobile = document.getElementById("job-mobile");
            var jobEmailValue = jobEmail.value.trim();
            var jobMobileValue = jobMobile.value.trim();
            var jobEmailValueLength = jobEmailValue.length;
            var jobMobileValueLength = jobMobileValue.length;
            var jobEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
            var jobmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
    
            if(!jobEmailValueLength && !jobMobileValueLength){
               jobEmail.placeholder = "Please Fill Email Address Or Mobile Number";
               jobMobile.placeholder = "Please Fill Email Address Or Mobile Number";
               jobEmail.classList.add("placeholder_color_border");
               jobMobile.classList.add("placeholder_color_border");
               jobEmail.focus();
               jobMobile.focus();
               jobEmail.onclick = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               jobEmail.onkeydown = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               jobMobile.onclick = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               jobMobile.onkeydown = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               return false;
            }else if(!jobEmailValue.match(jobEmailRegEx) && !jobMobileValue.match(jobmobileRegEx)){
               
               jobEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
               jobMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
               jobEmail.classList.add("placeholder_color_border");
               jobMobile.classList.add("placeholder_color_border");
               jobEmail.value = "";
               jobMobile.value = "";
               jobEmail.focus();
               jobMobile.focus();
               jobEmail.onclick = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
                   jobEmail.value = jobEmailValue;
                   jobMobile.value = jobMobileValue;
               }
               jobEmail.onkeydown = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               jobMobile.onclick = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
                   jobEmail.value = jobEmailValue;
                   jobMobile.value = jobMobileValue;
               }
               jobMobile.onkeydown = function(){
                   jobEmail.classList.remove("placeholder_color_border");
                   jobMobile.classList.remove("placeholder_color_border");
               }
               
               return false;
            }
            
        /* END job email and mobile*/
        /*  job location*/
        /* for job  location*/
        var jobLocation = document.getElementById("job-location");
        var jobLocationValue = jobLocation.value.trim();
        var jobLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var jobLocationRegex = /([a-zA-Z0-9-. ]+)?/;
        if(!jobLocationValue.match(jobLocationRegex) || jobLocationValue.match(jobLocationRegex1)){
            jobLocation.placeholder = "please Enter Correct Location";
            jobLocation.value = "";
            jobLocation.classList.add("placeholder_color_border");
            jobLocation.focus();
            jobLocation.onclick = function(){
                jobLocation.classList.remove("placeholder_color_border");
                jobLocation.value = jobLocationValue;
            }
            jobLocation.onkeydown = function(){
                jobLocation.classList.remove("placeholder_color_border");
                
            }
            return false;
    
            
        }
        /* END for job  location*/
        /* for job Street*/
        var jobStreet = document.getElementById("job-street");
        var jobStreetValue = jobStreet.value.trim();
        var jobStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
        var jobStreetRegex = /([a-zA-Z0-9 .-]+)?/;
        if(!jobStreetValue.match(jobStreetRegex) || jobStreetValue.match(jobStreetRegex1)){
            jobStreet.placeholder = "please Enter Correct Street";
            jobStreet.value = "";
            jobStreet.classList.add("placeholder_color_border");
            jobStreet.focus();
            jobStreet.onclick = function(){
                jobStreet.classList.remove("placeholder_color_border");
                jobStreet.value = jobStreetValue;
            }
            jobStreet.onkeydown = function(){
                jobStreet.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for job Street*/
        /* for job State and city*/        
    
        /* END for job State and city*/
        /* for job Zip Code*/
        var jobZipCode = document.getElementById("job-zip");
        var jobZipCodeValue = jobZipCode.value.trim();
        var jobZipCodeRegEx = /(^(631)+\d{2}$)/;
        if(jobZipCodeValue == null || jobZipCodeValue == "" || !jobZipCodeValue.match(jobZipCodeRegEx)){
            jobZipCode.placeholder = "please Enter Correct Zip Code";
            jobZipCode.value = "";
            jobZipCode.classList.add("placeholder_color_border");
            jobZipCode.focus();
            jobZipCode.onclick = function(){
                jobZipCode.classList.remove("placeholder_color_border");
                jobZipCode.value = jobZipCodeValue;
            }
            jobZipCode.onkeydown = function(){
                jobZipCode.classList.remove("placeholder_color_border");
                
            }
            return false;
        }
        /* END for job Zip Code*/
        /*  for job Description */
            var jobDescription = document.getElementById("job-description");
            var jobDescriptionValue = jobDescription.value.trim();
            if(jobDescriptionValue == null || jobDescriptionValue == "" || jobDescriptionValue.length < 3){
                jobDescription.placeholder = "please Enter Atleast Three Characters";
                jobDescription.value = "";
                jobDescription.classList.add("placeholder_color_border");
                jobDescription.focus();
                jobDescription.onclick = function(){
                    jobDescription.classList.remove("placeholder_color_border");
                    jobDescription.value = jobDescriptionValue;
                }
                jobDescription.onkeydown = function(){
                    jobDescription.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for job Description */
            /*job image file*/
            var jobImageFile = document.getElementById("job-image-file");
            var jobImageFileValue = jobImageFile.value;
            var jobImageFileRegEx = /(.*?)(\.)(jpg|bmp|jpeg|png|svg|gif|JPG)$/;
            if(jobImageFileValue == "" || jobImageFileValue == null){
              
               
            }else {
                if(!jobImageFileValue.match(jobImageFileRegEx)){
                    jobImageFile.classList.add("placeholder_color_border", "image-files");
                    jobImageFile.title = "Please select correct extensions";
                    jobImageFile.focus();
                    jobImageFile.onclick = function(){
                        jobImageFile.classList.remove("placeholder_color_border", "image-files");
                    }
                    return false;
                }
                var jobImageFileLength = jobImageFile.files.length;
    
                if (jobImageFileLength > 3){
                    jobImageFile.classList.add("placeholder_color_border", "image-files-two");
                    jobImageFile.title = "Please Upload only three images";
                    jobImageFile.focus();
                    jobImageFile.onclick = function(){
                        jobImageFile.classList.remove("placeholder_color_border", "image-files-two");
                    }
                
                    return false;
                }
                var jobImageFileSize = jobImageFile.files[0].size;
                if( ( jobImageFileSize /1024 /1024) > 1){
                    jobImageFile.classList.add("placeholder_color_border", "image-files-one");
                    jobImageFile.title = "Your File Should Be less Than 1 MB";
                    jobImageFile.focus();
                    jobImageFile.onclick = function(){
                        jobImageFile.classList.remove("placeholder_color_border", "image-files-one");
                    }
                    return false;
                }
            }
            /*END job image file*/
            /* job website link*/
            var jobUrl = document.getElementById("job-url");               
            var jobUrlValue = jobUrl.value.trim();               
            var jobUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            var jobUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            if(jobUrlValue == "" || jobUrlValue == null){
                         
            }else {
                if(!jobUrlValue.match(jobUrlRegex1)){
                    jobUrl.placeholder = "Please Enter www.";
                    jobUrl.value = "";
                    jobUrl.classList.add("placeholder_color_border");
                    jobUrl.focus();
                    jobUrl.onclick = function(){
                        jobUrl.classList.remove("placeholder_color_border");
                        jobUrl.value = jobUrlValue;
                    }
                    jobUrl.onkeydown = function(){
                        jobUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }else if(!jobUrlValue.match(jobUrlRegex2)){
                    jobUrl.placeholder = "Please Enter http or https correctly";
                    jobUrl.value = "";
                    jobUrl.classList.add("placeholder_color_border");
                    jobUrl.focus();
                    jobUrl.onclick = function(){
                        jobUrl.classList.remove("placeholder_color_border");
                        jobUrl.value = jobUrlValue;
                    }
                    jobUrl.onkeydown = function(){
                        jobUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            }
            /* END job website link*/
            
            
    
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 32){
            /*catering title*/
            var cateringTitle = document.getElementById("catering-title");
            var cateringTitleValue = cateringTitle.value.trim();
            if(cateringTitleValue == null || cateringTitleValue == ""){
                cateringTitle.placeholder = "Please Fill This Field";
                cateringTitle.classList.add("placeholder_color_border");
                cateringTitle.focus();
                cateringTitle.onclick = function(){
                    cateringTitle.classList.remove("placeholder_color_border");
                }
                cateringTitle.onkeydown = function(){
                    cateringTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(cateringTitleValue.length < 4){
                cateringTitle.placeholder = "Please Enter Atleast Four Characters";
                cateringTitle.classList.add("placeholder_color_border");
                cateringTitle.value = "";
                cateringTitle.focus();
                cateringTitle.onclick = function(){
                    cateringTitle.classList.remove("placeholder_color_border");
                    cateringTitle.value = cateringTitleValue;
                }
                cateringTitle.onkeydown = function(){
                    cateringTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END catering title*/
            /* catering email and mobile*/
                var cateringEmail = document.getElementById("catering-email");
                var cateringMobile = document.getElementById("catering-mobile");
                var cateringEmailValue = cateringEmail.value.trim();
                var cateringMobileValue = cateringMobile.value.trim();
                var cateringEmailValueLength = cateringEmailValue.length;
                var cateringMobileValueLength = cateringMobileValue.length;
                var cateringEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var cateringmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
        
                if(!cateringEmailValueLength && !cateringMobileValueLength){
                cateringEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                cateringMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                cateringEmail.classList.add("placeholder_color_border");
                cateringMobile.classList.add("placeholder_color_border");
                cateringEmail.focus();
                cateringMobile.focus();
                cateringEmail.onclick = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                cateringEmail.onkeydown = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                cateringMobile.onclick = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                cateringMobile.onkeydown = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                return false;
                }else if(!cateringEmailValue.match(cateringEmailRegEx) && !cateringMobileValue.match(cateringmobileRegEx)){
                
                cateringEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                cateringMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                cateringEmail.classList.add("placeholder_color_border");
                cateringMobile.classList.add("placeholder_color_border");
                cateringEmail.value = "";
                cateringMobile.value = "";
                cateringEmail.focus();
                cateringMobile.focus();
                cateringEmail.onclick = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                    cateringEmail.value = cateringEmailValue;
                    cateringMobile.value = cateringMobileValue;
                }
                cateringEmail.onkeydown = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                cateringMobile.onclick = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                    cateringEmail.value = cateringEmailValue;
                    cateringMobile.value = cateringMobileValue;
                }
                cateringMobile.onkeydown = function(){
                    cateringEmail.classList.remove("placeholder_color_border");
                    cateringMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
                }
                
            /* END catering email and mobile*/
            /* catering owner name*/
               
            var cateringOwnerName = document.getElementById("catering-ownername");
            var cateringOwnerNameValue = cateringOwnerName.value.trim(); 
            var cateringOwnerNameRegEx = /^([a-zA-Z ']){2}/;
            if(cateringOwnerNameValue == null || cateringOwnerNameValue == ""){
                cateringOwnerName.placeholder ="please Enter Owner  Name";
                cateringOwnerName.classList.add("placeholder_color_border");
                cateringOwnerName.focus();
                cateringOwnerName.onclick = function(){
                    cateringOwnerName.classList.remove("placeholder_color_border");
                    
                }
                cateringOwnerName.onkeydown = function(){
                    cateringOwnerName.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(!cateringOwnerNameValue.match(cateringOwnerNameRegEx)){
                cateringOwnerName.placeholder = "Please Enter Owner name Should Be in Atleast Two Characters and Not Use Numbers";
                cateringOwnerName.classList.add("placeholder_color_border");           
                cateringOwnerName.value = "";
                cateringOwnerName.focus();
                cateringOwnerName.onclick = function(){
                    cateringOwnerName.classList.remove("placeholder_color_border");
                    cateringOwnerName.value = cateringOwnerNameValue;
                }
                cateringOwnerName.onkeydown = function(){
                        cateringOwnerName.classList.remove("placeholder_color_border");
                    }
                return false;
            }
            
            /* END catering owner name*/
            /*  catering location*/
            /* for catering  location*/
            var cateringLocation = document.getElementById("catering-location");
            var cateringLocationValue = cateringLocation.value.trim();
            var cateringLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var cateringLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!cateringLocationValue.match(cateringLocationRegex) || cateringLocationValue.match(cateringLocationRegex1)){
                cateringLocation.placeholder = "please Enter Correct Location";
                cateringLocation.value = "";
                cateringLocation.classList.add("placeholder_color_border");
                cateringLocation.focus();
                cateringLocation.onclick = function(){
                    cateringLocation.classList.remove("placeholder_color_border");
                    cateringLocation.value = cateringLocationValue;
                }
                cateringLocation.onkeydown = function(){
                    cateringLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
        
                
            }
            /* END for catering  location*/
            /* for catering Street*/
            var cateringStreet = document.getElementById("catering-street");
            var cateringStreetValue = cateringStreet.value.trim();
            var cateringStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var cateringStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!cateringStreetValue.match(cateringStreetRegex) || cateringStreetValue.match(cateringStreetRegex1)){
                cateringStreet.placeholder = "please Enter Correct Street";
                cateringStreet.value = "";
                cateringStreet.classList.add("placeholder_color_border");
                cateringStreet.focus();
                cateringStreet.onclick = function(){
                    cateringStreet.classList.remove("placeholder_color_border");
                    cateringStreet.value = cateringStreetValue;
                }
                cateringStreet.onkeydown = function(){
                    cateringStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for catering Street*/
            /* for catering State and city*/        
        
            /* END for catering State and city*/
            /* for catering Zip Code*/
            var cateringZipCode = document.getElementById("catering-zip");
            var cateringZipCodeValue = cateringZipCode.value.trim();
            var cateringZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(cateringZipCodeValue == null || cateringZipCodeValue == "" || !cateringZipCodeValue.match(cateringZipCodeRegEx)){
                cateringZipCode.placeholder = "please Enter Correct Zip Code";
                cateringZipCode.value = "";
                cateringZipCode.classList.add("placeholder_color_border");
                cateringZipCode.focus();
                cateringZipCode.onclick = function(){
                    cateringZipCode.classList.remove("placeholder_color_border");
                    cateringZipCode.value = cateringZipCodeValue;
                }
                cateringZipCode.onkeydown = function(){
                    cateringZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for catering Zip Code*/
            /*  for catering Description */
                var cateringDescription = document.getElementById("catering-description");
                var cateringDescriptionValue = cateringDescription.value.trim();
                if(cateringDescriptionValue == null || cateringDescriptionValue == "" || cateringDescriptionValue.length < 3){
                    cateringDescription.placeholder = "please Enter Atleast Three Characters";
                    cateringDescription.value = "";
                    cateringDescription.classList.add("placeholder_color_border");
                    cateringDescription.focus();
                    cateringDescription.onclick = function(){
                        cateringDescription.classList.remove("placeholder_color_border");
                        cateringDescription.value = cateringDescriptionValue;
                    }
                    cateringDescription.onkeydown = function(){
                        cateringDescription.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for catering Description */
        
            /* for catering images and url*/
            var cateringImageFile = document.getElementById("catering-image-file");
            var cateringImageFileValue = cateringImageFile.value;
            var cateringImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;            
            
            if(cateringImageFileValue == null || cateringImageFileValue == "" ){
                
               
            }else {
                if(!cateringImageFileValue.match(cateringImageRegex)){
                    cateringImageFile.classList.add("placeholder_color_border", "image-files");
                    cateringImageFile.title = "Please select correct extensions";
                    cateringImageFile.focus();
                    cateringImageFile.onclick = function(){
                        cateringImageFile.classList.remove("placeholder_color_border", "image-files");
                    }
                    return false;
                }
                var cateringImageFileLength = cateringImageFile.files.length;
                if (cateringImageFileLength > 3){
                    cateringImageFile.classList.add("placeholder_color_border", "image-files-two");
                    cateringImageFile.title = "Please Upload only three images";
                    cateringImageFile.focus();
                    cateringImageFile.onclick = function(){
                        cateringImageFile.classList.remove("placeholder_color_border", "image-files-two");
                    }
                
                    return false;
                }
                var cateringImageFileSize = cateringImageFile.files[0].size;
                if( ( cateringImageFileSize /1024 /1024) > 1){
                    cateringImageFile.classList.add("placeholder_color_border", "image-files-one");
                    cateringImageFile.title = "Your File Should Be less Than 1 MB";
                    cateringImageFile.focus();
                    cateringImageFile.onclick = function(){
                        cateringImageFile.classList.remove("placeholder_color_border", "image-files-one");
                    }
                    return false;
                }
            }    
           /*END  for catering images*/
           /* for catering  url*/
            var cateringUrl = document.getElementById("catering-url");               
            var cateringUrlValue = cateringUrl.value.trim();               
            var cateringUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            var cateringUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            if(cateringUrlValue == null || cateringUrlValue == "" ){
                
               
            }
            else{
                if(!cateringUrlValue.match(cateringUrlRegex1)){
                    cateringUrl.placeholder = "Please Enter www.";
                    cateringUrl.value = "";
                    cateringUrl.classList.add("placeholder_color_border");
                    cateringUrl.focus();
                    cateringUrl.onclick = function(){
                        cateringUrl.classList.remove("placeholder_color_border");
                        cateringUrl.value = cateringUrlValue;
                    }
                    cateringUrl.onkeydown = function(){
                        cateringUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }else if(!cateringUrlValue.match(cateringUrlRegex2)){
                    cateringUrl.placeholder = "Please Enter http or https correctly";
                    cateringUrl.value = "";
                    cateringUrl.classList.add("placeholder_color_border");
                    cateringUrl.focus();
                    cateringUrl.onclick = function(){
                        cateringUrl.classList.remove("placeholder_color_border");
                        cateringUrl.value = cateringUrlValue;
                    }
                    cateringUrl.onkeydown = function(){
                        cateringUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            }                 
            /* END for catering  url*/
            /*for catering price*/
            var cateringPrice = document.getElementById("catering-price");
            var cateringPriceValue = cateringPrice.value.trim();
            var cateringPriceRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
            if(cateringPriceValue == null || cateringPriceValue == ""){
    
            }
            else{
                if(!cateringPriceValue.match(cateringPriceRegEx)){
                    cateringPrice.placeholder = "please Enter Price ";
                    cateringPrice.value = "";
                    cateringPrice.classList.add("placeholder_color_border");
                    cateringPrice.focus();
                    cateringPrice.onclick = function(){
                        cateringPrice.classList.remove("placeholder_color_border");
                        cateringPrice.value = cateringPriceValue;
                    }
                    cateringPrice.onkeydown = function(){
                        cateringPrice.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            }    
            /*END for catering price*/
            
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 34 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 35 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 36 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 37){
    
            /*services title*/
            var servicesTitle = document.getElementById("services-title");
            var servicesTitleValue = servicesTitle.value.trim();
            if(servicesTitleValue == null || servicesTitleValue == ""){
                servicesTitle.placeholder = "Please Fill This Field";
                servicesTitle.classList.add("placeholder_color_border");
                servicesTitle.focus();
                servicesTitle.onclick = function(){
                    servicesTitle.classList.remove("placeholder_color_border");
                }
                servicesTitle.onkeydown = function(){
                    servicesTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(servicesTitleValue.length < 4){
                servicesTitle.placeholder = "Please Enter Atleast Four Characters";
                servicesTitle.classList.add("placeholder_color_border");
                servicesTitle.value = "";
                servicesTitle.focus();
                servicesTitle.onclick = function(){
                    servicesTitle.classList.remove("placeholder_color_border");
                    servicesTitle.value = servicesTitleValue;
                }
                servicesTitle.onkeydown = function(){
                    servicesTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END services title*/
            /* services email and mobile*/
                var servicesEmail = document.getElementById("services-email");
                var servicesMobile = document.getElementById("services-mobile");
                var servicesEmailValue = servicesEmail.value.trim();
                var servicesMobileValue = servicesMobile.value.trim();
                var servicesEmailValueLength = servicesEmailValue.length;
                var servicesMobileValueLength = servicesMobileValue.length;
                var servicesEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var servicesmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
        
                if(!servicesEmailValueLength && !servicesMobileValueLength){
                servicesEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                servicesMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                servicesEmail.classList.add("placeholder_color_border");
                servicesMobile.classList.add("placeholder_color_border");
                servicesEmail.focus();
                servicesMobile.focus();
                servicesEmail.onclick = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                servicesEmail.onkeydown = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                servicesMobile.onclick = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                servicesMobile.onkeydown = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                return false;
                }else if(!servicesEmailValue.match(servicesEmailRegEx) && !servicesMobileValue.match(servicesmobileRegEx)){
                
                servicesEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                servicesMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                servicesEmail.classList.add("placeholder_color_border");
                servicesMobile.classList.add("placeholder_color_border");
                servicesEmail.value = "";
                servicesMobile.value = "";
                servicesEmail.focus();
                servicesMobile.focus();
                servicesEmail.onclick = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                    servicesEmail.value = servicesEmailValue;
                    servicesMobile.value = servicesMobileValue;
                }
                servicesEmail.onkeydown = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                servicesMobile.onclick = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                    servicesEmail.value = servicesEmailValue;
                    servicesMobile.value = servicesMobileValue;
                }
                servicesMobile.onkeydown = function(){
                    servicesEmail.classList.remove("placeholder_color_border");
                    servicesMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
                }
                
            /* END services email and mobile*/
    
            /* services owner name*/
               
            var servicesOwnerName = document.getElementById("services-ownername");
            var servicesOwnerNameValue = servicesOwnerName.value.trim(); 
            var servicesOwnerNameRegEx = /^([a-zA-Z ']){2}/;
            if(servicesOwnerNameValue == null || servicesOwnerNameValue == ""){
                servicesOwnerName.placeholder ="please Enter Owner  Name";
                servicesOwnerName.classList.add("placeholder_color_border");
                servicesOwnerName.focus();
                servicesOwnerName.onclick = function(){
                    servicesOwnerName.classList.remove("placeholder_color_border");
                    
                }
                servicesOwnerName.onkeydown = function(){
                    servicesOwnerName.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(!servicesOwnerNameValue.match(servicesOwnerNameRegEx)){
                servicesOwnerName.placeholder = "Please Enter Owner name Should Be in Atleast Two Characters and Not Use Numbers";
                servicesOwnerName.classList.add("placeholder_color_border");           
                servicesOwnerName.value = "";
                servicesOwnerName.focus();
                servicesOwnerName.onclick = function(){
                    servicesOwnerName.classList.remove("placeholder_color_border");
                    servicesOwnerName.value = servicesOwnerNameValue;
                }
                servicesOwnerName.onkeydown = function(){
                        servicesOwnerName.classList.remove("placeholder_color_border");
                    }
                return false;
            }
            
            /* END services owner name*/
            /*  services location*/
            /* for services  location*/
            var servicesLocation = document.getElementById("services-location");
            var servicesLocationValue = servicesLocation.value.trim();
            var servicesLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var servicesLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!servicesLocationValue.match(servicesLocationRegex) || servicesLocationValue.match(servicesLocationRegex1)){
                servicesLocation.placeholder = "please Enter Correct Location";
                servicesLocation.value = "";
                servicesLocation.classList.add("placeholder_color_border");
                servicesLocation.focus();
                servicesLocation.onclick = function(){
                    servicesLocation.classList.remove("placeholder_color_border");
                    servicesLocation.value = servicesLocationValue;
                }
                servicesLocation.onkeydown = function(){
                    servicesLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
        
                
            }
            /* END for services  location*/
            /* for services Street*/
            var servicesStreet = document.getElementById("services-street");
            var servicesStreetValue = servicesStreet.value.trim();
            var servicesStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var servicesStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!servicesStreetValue.match(servicesStreetRegex) || servicesStreetValue.match(servicesStreetRegex1)){
                servicesStreet.placeholder = "please Enter Correct Street";
                servicesStreet.value = "";
                servicesStreet.classList.add("placeholder_color_border");
                servicesStreet.focus();
                servicesStreet.onclick = function(){
                    servicesStreet.classList.remove("placeholder_color_border");
                    servicesStreet.value = servicesStreetValue;
                }
                servicesStreet.onkeydown = function(){
                    servicesStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for services Street*/
            /* for services State and city*/        
        
            /* END for services State and city*/
            /* for services Zip Code*/
            var servicesZipCode = document.getElementById("services-zip");
            var servicesZipCodeValue = servicesZipCode.value.trim();
            var servicesZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(servicesZipCodeValue == null || servicesZipCodeValue == "" || !servicesZipCodeValue.match(servicesZipCodeRegEx)){
                servicesZipCode.placeholder = "please Enter Correct Zip Code";
                servicesZipCode.value = "";
                servicesZipCode.classList.add("placeholder_color_border");
                servicesZipCode.focus();
                servicesZipCode.onclick = function(){
                    servicesZipCode.classList.remove("placeholder_color_border");
                    servicesZipCode.value = servicesZipCodeValue;
                }
                servicesZipCode.onkeydown = function(){
                    servicesZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for services Zip Code*/
            /*  for services Description */
                var servicesDescription = document.getElementById("services-description");
                var servicesDescriptionValue = servicesDescription.value.trim();
                if(servicesDescriptionValue == null || servicesDescriptionValue == "" || servicesDescriptionValue.length < 3){
                    servicesDescription.placeholder = "please Enter Atleast Three Characters";
                    servicesDescription.value = "";
                    servicesDescription.classList.add("placeholder_color_border");
                    servicesDescription.focus();
                    servicesDescription.onclick = function(){
                        servicesDescription.classList.remove("placeholder_color_border");
                        servicesDescription.value = servicesDescriptionValue;
                    }
                    servicesDescription.onkeydown = function(){
                        servicesDescription.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for services Description */
        
            /* for services images */
            var servicesImageFile = document.getElementById("services-image-file");
            var servicesImageFileValue = servicesImageFile.value;
            var servicesImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;            
            
            if(servicesImageFileValue == null || servicesImageFileValue == "" ){
                
               
            }else {
                if(!servicesImageFileValue.match(servicesImageRegex)){
                    servicesImageFile.classList.add("placeholder_color_border", "image-files");
                    servicesImageFile.title = "Please select correct extensions";
                    servicesImageFile.focus();
                    servicesImageFile.onclick = function(){
                        servicesImageFile.classList.remove("placeholder_color_border", "image-files");
                    }
                    return false;
                }
                var servicesImageFileLength = servicesImageFile.files.length;
                if (servicesImageFileLength > 3){
                    servicesImageFile.classList.add("placeholder_color_border", "image-files-two");
                    servicesImageFile.title = "Please Upload only three images";
                    servicesImageFile.focus();
                    servicesImageFile.onclick = function(){
                        servicesImageFile.classList.remove("placeholder_color_border", "image-files-two");
                    }
                
                    return false;
                }
                var servicesImageFileSize = servicesImageFile.files[0].size;
                if( ( servicesImageFileSize /1024 /1024) > 1){
                    servicesImageFile.classList.add("placeholder_color_border", "image-files-one");
                    servicesImageFile.title = "Your File Should Be less Than 1 MB";
                    servicesImageFile.focus();
                    servicesImageFile.onclick = function(){
                        servicesImageFile.classList.remove("placeholder_color_border", "image-files-one");
                    }
                    return false;
                }
            }    
           /*END  for services images*/
           /* for services  url*/
            var servicesUrl = document.getElementById("services-url");               
            var servicesUrlValue = servicesUrl.value.trim();               
            var servicesUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            var servicesUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
            if(servicesUrlValue == null || servicesUrlValue == "" ){
                
               
            }
            else{
                if(!servicesUrlValue.match(servicesUrlRegex1)){
                    servicesUrl.placeholder = "Please Enter www.";
                    servicesUrl.value = "";
                    servicesUrl.classList.add("placeholder_color_border");
                    servicesUrl.focus();
                    servicesUrl.onclick = function(){
                        servicesUrl.classList.remove("placeholder_color_border");
                        servicesUrl.value = servicesUrlValue;
                    }
                    servicesUrl.onkeydown = function(){
                        servicesUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }else if(!servicesUrlValue.match(servicesUrlRegex2)){
                    servicesUrl.placeholder = "Please Enter http or https correctly";
                    servicesUrl.value = "";
                    servicesUrl.classList.add("placeholder_color_border");
                    servicesUrl.focus();
                    servicesUrl.onclick = function(){
                        servicesUrl.classList.remove("placeholder_color_border");
                        servicesUrl.value = servicesUrlValue;
                    }
                    servicesUrl.onkeydown = function(){
                        servicesUrl.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            }                 
            /* END for services  url*/
    
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 30 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 31){
            /*twoAndSixCategory title*/
            var twoAndSixCategoryTitle = document.getElementById("two-and-six-category-title");
            var twoAndSixCategoryTitleValue = twoAndSixCategoryTitle.value.trim();
            if(twoAndSixCategoryTitleValue == null || twoAndSixCategoryTitleValue == ""){
                twoAndSixCategoryTitle.placeholder = "Please Fill This Field";
                twoAndSixCategoryTitle.classList.add("placeholder_color_border");
                twoAndSixCategoryTitle.focus();
                twoAndSixCategoryTitle.onclick = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryTitle.onkeydown = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(twoAndSixCategoryTitleValue.length < 4){
                twoAndSixCategoryTitle.placeholder = "Please Enter Atleast Four Characters";
                twoAndSixCategoryTitle.classList.add("placeholder_color_border");
                twoAndSixCategoryTitle.value = "";
                twoAndSixCategoryTitle.focus();
                twoAndSixCategoryTitle.onclick = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                    twoAndSixCategoryTitle.value = twoAndSixCategoryTitleValue;
                }
                twoAndSixCategoryTitle.onkeydown = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END twoAndSixCategory title*/
            /* twoAndSixCategory email and mobile*/
                var twoAndSixCategoryEmail = document.getElementById("two-and-six-category-email");
                var twoAndSixCategoryMobile = document.getElementById("two-and-six-category-mobile");
                var twoAndSixCategoryEmailValue = twoAndSixCategoryEmail.value.trim();
                var twoAndSixCategoryMobileValue = twoAndSixCategoryMobile.value.trim();
                var twoAndSixCategoryEmailValueLength = twoAndSixCategoryEmailValue.length;
                var twoAndSixCategoryMobileValueLength = twoAndSixCategoryMobileValue.length;
                var twoAndSixCategoryEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var twoAndSixCategorymobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
        
                if(!twoAndSixCategoryEmailValueLength && !twoAndSixCategoryMobileValueLength){
                twoAndSixCategoryEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                twoAndSixCategoryMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                twoAndSixCategoryEmail.classList.add("placeholder_color_border");
                twoAndSixCategoryMobile.classList.add("placeholder_color_border");
                twoAndSixCategoryEmail.focus();
                twoAndSixCategoryMobile.focus();
                twoAndSixCategoryEmail.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryEmail.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                return false;
                }else if(!twoAndSixCategoryEmailValue.match(twoAndSixCategoryEmailRegEx) && !twoAndSixCategoryMobileValue.match(twoAndSixCategorymobileRegEx)){
                
                twoAndSixCategoryEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                twoAndSixCategoryMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                twoAndSixCategoryEmail.classList.add("placeholder_color_border");
                twoAndSixCategoryMobile.classList.add("placeholder_color_border");
                twoAndSixCategoryEmail.value = "";
                twoAndSixCategoryMobile.value = "";
                twoAndSixCategoryEmail.focus();
                twoAndSixCategoryMobile.focus();
                twoAndSixCategoryEmail.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                    twoAndSixCategoryEmail.value = twoAndSixCategoryEmailValue;
                    twoAndSixCategoryMobile.value = twoAndSixCategoryMobileValue;
                }
                twoAndSixCategoryEmail.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                    twoAndSixCategoryEmail.value = twoAndSixCategoryEmailValue;
                    twoAndSixCategoryMobile.value = twoAndSixCategoryMobileValue;
                }
                twoAndSixCategoryMobile.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
                }
                
            /* END twoAndSixCategory email and mobile*/
            /*for twoAndSixCategory price*/
            var twoAndSixCategoryPrice = document.getElementById("two-and-six-category-price");
            var twoAndSixCategoryPriceValue = twoAndSixCategoryPrice.value.trim();
            var twoAndSixCategoryPriceRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
            if(twoAndSixCategoryPriceValue == null || twoAndSixCategoryPriceValue == "" || !twoAndSixCategoryPriceValue.match(twoAndSixCategoryPriceRegEx)){    
                twoAndSixCategoryPrice.placeholder = "please Enter price  ";
                twoAndSixCategoryPrice.value = "";
                twoAndSixCategoryPrice.classList.add("placeholder_color_border");
                twoAndSixCategoryPrice.focus();
                twoAndSixCategoryPrice.onclick = function(){
                    twoAndSixCategoryPrice.classList.remove("placeholder_color_border");
                    twoAndSixCategoryPrice.value = twoAndSixCategoryPriceValue;
                }
                twoAndSixCategoryPrice.onkeydown = function(){
                    twoAndSixCategoryPrice.classList.remove("placeholder_color_border");
                    
                }
                return false;
            
            }    
            /*END for twoAndSixCategory price*/
            /* twoAndSixCategory owner name*/
               
            var twoAndSixCategoryOwnerName = document.getElementById("two-and-six-category-ownername");
            var twoAndSixCategoryOwnerNameValue = twoAndSixCategoryOwnerName.value.trim(); 
            var twoAndSixCategoryOwnerNameRegEx = /^([a-zA-Z ']){2}/;
            if(twoAndSixCategoryOwnerNameValue == null || twoAndSixCategoryOwnerNameValue == ""){
                twoAndSixCategoryOwnerName.placeholder ="please Enter Owner  Name";
                twoAndSixCategoryOwnerName.classList.add("placeholder_color_border");
                twoAndSixCategoryOwnerName.focus();
                twoAndSixCategoryOwnerName.onclick = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    
                }
                twoAndSixCategoryOwnerName.onkeydown = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(!twoAndSixCategoryOwnerNameValue.match(twoAndSixCategoryOwnerNameRegEx)){
                twoAndSixCategoryOwnerName.placeholder = "Please Enter Owner name Should Be in Atleast Two Characters and Not Use Numbers";
                twoAndSixCategoryOwnerName.classList.add("placeholder_color_border");           
                twoAndSixCategoryOwnerName.value = "";
                twoAndSixCategoryOwnerName.focus();
                twoAndSixCategoryOwnerName.onclick = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    twoAndSixCategoryOwnerName.value = twoAndSixCategoryOwnerNameValue;
                }
                twoAndSixCategoryOwnerName.onkeydown = function(){
                        twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    }
                return false;
            }
            
            /* END twoAndSixCategory owner name*/
            /*  twoAndSixCategory location*/
            /* for twoAndSixCategory  location*/
            var twoAndSixCategoryLocation = document.getElementById("two-and-six-category-location");
            var twoAndSixCategoryLocationValue = twoAndSixCategoryLocation.value.trim();
            var twoAndSixCategoryLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var twoAndSixCategoryLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!twoAndSixCategoryLocationValue.match(twoAndSixCategoryLocationRegex) || twoAndSixCategoryLocationValue.match(twoAndSixCategoryLocationRegex1)){
                twoAndSixCategoryLocation.placeholder = "please Enter Correct Location";
                twoAndSixCategoryLocation.value = "";
                twoAndSixCategoryLocation.classList.add("placeholder_color_border");
                twoAndSixCategoryLocation.focus();
                twoAndSixCategoryLocation.onclick = function(){
                    twoAndSixCategoryLocation.classList.remove("placeholder_color_border");
                    twoAndSixCategoryLocation.value = twoAndSixCategoryLocationValue;
                }
                twoAndSixCategoryLocation.onkeydown = function(){
                    twoAndSixCategoryLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
        
                
            }
            /* END for twoAndSixCategory  location*/
            /* for twoAndSixCategory Street*/
            var twoAndSixCategoryStreet = document.getElementById("two-and-six-category-street");
            var twoAndSixCategoryStreetValue = twoAndSixCategoryStreet.value.trim();
            var twoAndSixCategoryStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var twoAndSixCategoryStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!twoAndSixCategoryStreetValue.match(twoAndSixCategoryStreetRegex) || twoAndSixCategoryStreetValue.match(twoAndSixCategoryStreetRegex1)){
                twoAndSixCategoryStreet.placeholder = "please Enter Correct Street";
                twoAndSixCategoryStreet.value = "";
                twoAndSixCategoryStreet.classList.add("placeholder_color_border");
                twoAndSixCategoryStreet.focus();
                twoAndSixCategoryStreet.onclick = function(){
                    twoAndSixCategoryStreet.classList.remove("placeholder_color_border");
                    twoAndSixCategoryStreet.value = twoAndSixCategoryStreetValue;
                }
                twoAndSixCategoryStreet.onkeydown = function(){
                    twoAndSixCategoryStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for twoAndSixCategory Street*/
            /* for twoAndSixCategory State and city*/        
        
            /* END for twoAndSixCategory State and city*/
            /* for twoAndSixCategory Zip Code*/
            var twoAndSixCategoryZipCode = document.getElementById("two-and-six-category-zip");
            var twoAndSixCategoryZipCodeValue = twoAndSixCategoryZipCode.value.trim();
            var twoAndSixCategoryZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(twoAndSixCategoryZipCodeValue == null || twoAndSixCategoryZipCodeValue == "" || !twoAndSixCategoryZipCodeValue.match(twoAndSixCategoryZipCodeRegEx)){
                twoAndSixCategoryZipCode.placeholder = "please Enter Correct Zip Code";
                twoAndSixCategoryZipCode.value = "";
                twoAndSixCategoryZipCode.classList.add("placeholder_color_border");
                twoAndSixCategoryZipCode.focus();
                twoAndSixCategoryZipCode.onclick = function(){
                    twoAndSixCategoryZipCode.classList.remove("placeholder_color_border");
                    twoAndSixCategoryZipCode.value = twoAndSixCategoryZipCodeValue;
                }
                twoAndSixCategoryZipCode.onkeydown = function(){
                    twoAndSixCategoryZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for twoAndSixCategory Zip Code*/
            /*  for twoAndSixCategory Description */
                var twoAndSixCategoryDescription = document.getElementById("two-and-six-category-description");
                var twoAndSixCategoryDescriptionValue = twoAndSixCategoryDescription.value.trim();
                if(twoAndSixCategoryDescriptionValue == null || twoAndSixCategoryDescriptionValue == "" || twoAndSixCategoryDescriptionValue.length < 3){
                    twoAndSixCategoryDescription.placeholder = "please Enter Atleast Three Characters";
                    twoAndSixCategoryDescription.value = "";
                    twoAndSixCategoryDescription.classList.add("placeholder_color_border");
                    twoAndSixCategoryDescription.focus();
                    twoAndSixCategoryDescription.onclick = function(){
                        twoAndSixCategoryDescription.classList.remove("placeholder_color_border");
                        twoAndSixCategoryDescription.value = twoAndSixCategoryDescriptionValue;
                    }
                    twoAndSixCategoryDescription.onkeydown = function(){
                        twoAndSixCategoryDescription.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for twoAndSixCategory Description */
            /* for twoAndSixCategory images */
            var twoAndSixCategoryImageFile = document.getElementById("two-and-six-category-image-file");
            var twoAndSixCategoryImageFileValue = twoAndSixCategoryImageFile.value;
            var twoAndSixCategoryImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;            
            
            if(twoAndSixCategoryImageFileValue == null || twoAndSixCategoryImageFileValue == "" ){
                
               
            }else {
                if(!twoAndSixCategoryImageFileValue.match(twoAndSixCategoryImageRegex)){
                    twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files");
                    twoAndSixCategoryImageFile.title = "Please select correct extensions";
                    twoAndSixCategoryImageFile.focus();
                    twoAndSixCategoryImageFile.onclick = function(){
                        twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files");
                    }
                    return false;
                }
                var twoAndSixCategoryImageFileLength = twoAndSixCategoryImageFile.files.length;
                if (twoAndSixCategoryImageFileLength > 3){
                    twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files-two");
                    twoAndSixCategoryImageFile.title = "Please Upload only three images";
                    twoAndSixCategoryImageFile.focus();
                    twoAndSixCategoryImageFile.onclick = function(){
                        twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files-two");
                    }
                
                    return false;
                }
                var twoAndSixCategoryImageFileSize = twoAndSixCategoryImageFile.files[0].size;
                if( ( twoAndSixCategoryImageFileSize /1024 /1024) > 1){
                    twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files-one");
                    twoAndSixCategoryImageFile.title = "Your File Should Be less Than 1 MB";
                    twoAndSixCategoryImageFile.focus();
                    twoAndSixCategoryImageFile.onclick = function(){
                        twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files-one");
                    }
                    return false;
                }
            }    
           /*END  for twoAndSixCategory images*/
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 33){
    
            /*twoAndSixCategory title*/
            var twoAndSixCategoryTitle = document.getElementById("two-and-six-category-title");
            var twoAndSixCategoryTitleValue = twoAndSixCategoryTitle.value.trim();
            if(twoAndSixCategoryTitleValue == null || twoAndSixCategoryTitleValue == ""){
                twoAndSixCategoryTitle.placeholder = "Please Fill This Field";
                twoAndSixCategoryTitle.classList.add("placeholder_color_border");
                twoAndSixCategoryTitle.focus();
                twoAndSixCategoryTitle.onclick = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryTitle.onkeydown = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(twoAndSixCategoryTitleValue.length < 4){
                twoAndSixCategoryTitle.placeholder = "Please Enter Atleast Four Characters";
                twoAndSixCategoryTitle.classList.add("placeholder_color_border");
                twoAndSixCategoryTitle.value = "";
                twoAndSixCategoryTitle.focus();
                twoAndSixCategoryTitle.onclick = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                    twoAndSixCategoryTitle.value = twoAndSixCategoryTitleValue;
                }
                twoAndSixCategoryTitle.onkeydown = function(){
                    twoAndSixCategoryTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END twoAndSixCategory title*/
            /* twoAndSixCategory email and mobile*/
                var twoAndSixCategoryEmail = document.getElementById("two-and-six-category-email");
                var twoAndSixCategoryMobile = document.getElementById("two-and-six-category-mobile");
                var twoAndSixCategoryEmailValue = twoAndSixCategoryEmail.value.trim();
                var twoAndSixCategoryMobileValue = twoAndSixCategoryMobile.value.trim();
                var twoAndSixCategoryEmailValueLength = twoAndSixCategoryEmailValue.length;
                var twoAndSixCategoryMobileValueLength = twoAndSixCategoryMobileValue.length;
                var twoAndSixCategoryEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var twoAndSixCategorymobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
        
                if(!twoAndSixCategoryEmailValueLength && !twoAndSixCategoryMobileValueLength){
                twoAndSixCategoryEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                twoAndSixCategoryMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                twoAndSixCategoryEmail.classList.add("placeholder_color_border");
                twoAndSixCategoryMobile.classList.add("placeholder_color_border");
                twoAndSixCategoryEmail.focus();
                twoAndSixCategoryMobile.focus();
                twoAndSixCategoryEmail.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryEmail.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                return false;
                }else if(!twoAndSixCategoryEmailValue.match(twoAndSixCategoryEmailRegEx) && !twoAndSixCategoryMobileValue.match(twoAndSixCategorymobileRegEx)){
                
                twoAndSixCategoryEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                twoAndSixCategoryMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                twoAndSixCategoryEmail.classList.add("placeholder_color_border");
                twoAndSixCategoryMobile.classList.add("placeholder_color_border");
                twoAndSixCategoryEmail.value = "";
                twoAndSixCategoryMobile.value = "";
                twoAndSixCategoryEmail.focus();
                twoAndSixCategoryMobile.focus();
                twoAndSixCategoryEmail.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                    twoAndSixCategoryEmail.value = twoAndSixCategoryEmailValue;
                    twoAndSixCategoryMobile.value = twoAndSixCategoryMobileValue;
                }
                twoAndSixCategoryEmail.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                twoAndSixCategoryMobile.onclick = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                    twoAndSixCategoryEmail.value = twoAndSixCategoryEmailValue;
                    twoAndSixCategoryMobile.value = twoAndSixCategoryMobileValue;
                }
                twoAndSixCategoryMobile.onkeydown = function(){
                    twoAndSixCategoryEmail.classList.remove("placeholder_color_border");
                    twoAndSixCategoryMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
                }
                
            /* END twoAndSixCategory email and mobile*/
            /*for twoAndSixCategory price*/
            var twoAndSixCategoryPrice = document.getElementById("two-and-six-category-price");
            var twoAndSixCategoryPriceValue = twoAndSixCategoryPrice.value.trim();
            var twoAndSixCategoryPriceRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
            if(twoAndSixCategoryPriceValue == null || twoAndSixCategoryPriceValue == "" || !twoAndSixCategoryPriceValue.match(twoAndSixCategoryPriceRegEx)){    
                twoAndSixCategoryPrice.placeholder = "please Enter price  ";
                twoAndSixCategoryPrice.value = "";
                twoAndSixCategoryPrice.classList.add("placeholder_color_border");
                twoAndSixCategoryPrice.focus();
                twoAndSixCategoryPrice.onclick = function(){
                    twoAndSixCategoryPrice.classList.remove("placeholder_color_border");
                    twoAndSixCategoryPrice.value = twoAndSixCategoryPriceValue;
                }
                twoAndSixCategoryPrice.onkeydown = function(){
                    twoAndSixCategoryPrice.classList.remove("placeholder_color_border");
                    
                }
                return false;
            
            }    
            /*END for twoAndSixCategory price*/
            /* twoAndSixCategory owner name*/
               
            var twoAndSixCategoryOwnerName = document.getElementById("two-and-six-category-ownername");
            var twoAndSixCategoryOwnerNameValue = twoAndSixCategoryOwnerName.value.trim(); 
            var twoAndSixCategoryOwnerNameRegEx = /^([a-zA-Z ']){2}/;
            if(twoAndSixCategoryOwnerNameValue == null || twoAndSixCategoryOwnerNameValue == ""){
                twoAndSixCategoryOwnerName.placeholder ="please Enter Owner  Name";
                twoAndSixCategoryOwnerName.classList.add("placeholder_color_border");
                twoAndSixCategoryOwnerName.focus();
                twoAndSixCategoryOwnerName.onclick = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    
                }
                twoAndSixCategoryOwnerName.onkeydown = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(!twoAndSixCategoryOwnerNameValue.match(twoAndSixCategoryOwnerNameRegEx)){
                twoAndSixCategoryOwnerName.placeholder = "Please Enter Owner name Should Be in Atleast Two Characters and Not Use Numbers";
                twoAndSixCategoryOwnerName.classList.add("placeholder_color_border");           
                twoAndSixCategoryOwnerName.value = "";
                twoAndSixCategoryOwnerName.focus();
                twoAndSixCategoryOwnerName.onclick = function(){
                    twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    twoAndSixCategoryOwnerName.value = twoAndSixCategoryOwnerNameValue;
                }
                twoAndSixCategoryOwnerName.onkeydown = function(){
                        twoAndSixCategoryOwnerName.classList.remove("placeholder_color_border");
                    }
                return false;
            }
            
            /* END twoAndSixCategory owner name*/
            /*  twoAndSixCategory location*/
            /* for twoAndSixCategory  location*/
            var twoAndSixCategoryLocation = document.getElementById("two-and-six-category-location");
            var twoAndSixCategoryLocationValue = twoAndSixCategoryLocation.value.trim();
            var twoAndSixCategoryLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var twoAndSixCategoryLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!twoAndSixCategoryLocationValue.match(twoAndSixCategoryLocationRegex) || twoAndSixCategoryLocationValue.match(twoAndSixCategoryLocationRegex1)){
                twoAndSixCategoryLocation.placeholder = "please Enter Correct Location";
                twoAndSixCategoryLocation.value = "";
                twoAndSixCategoryLocation.classList.add("placeholder_color_border");
                twoAndSixCategoryLocation.focus();
                twoAndSixCategoryLocation.onclick = function(){
                    twoAndSixCategoryLocation.classList.remove("placeholder_color_border");
                    twoAndSixCategoryLocation.value = twoAndSixCategoryLocationValue;
                }
                twoAndSixCategoryLocation.onkeydown = function(){
                    twoAndSixCategoryLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
        
                
            }
            /* END for twoAndSixCategory  location*/
            /* for twoAndSixCategory Street*/
            var twoAndSixCategoryStreet = document.getElementById("two-and-six-category-street");
            var twoAndSixCategoryStreetValue = twoAndSixCategoryStreet.value.trim();
            var twoAndSixCategoryStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var twoAndSixCategoryStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!twoAndSixCategoryStreetValue.match(twoAndSixCategoryStreetRegex) || twoAndSixCategoryStreetValue.match(twoAndSixCategoryStreetRegex1)){
                twoAndSixCategoryStreet.placeholder = "please Enter Correct Street";
                twoAndSixCategoryStreet.value = "";
                twoAndSixCategoryStreet.classList.add("placeholder_color_border");
                twoAndSixCategoryStreet.focus();
                twoAndSixCategoryStreet.onclick = function(){
                    twoAndSixCategoryStreet.classList.remove("placeholder_color_border");
                    twoAndSixCategoryStreet.value = twoAndSixCategoryStreetValue;
                }
                twoAndSixCategoryStreet.onkeydown = function(){
                    twoAndSixCategoryStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for twoAndSixCategory Street*/
            /* for twoAndSixCategory State and city*/        
        
            /* END for twoAndSixCategory State and city*/
            /* for twoAndSixCategory Zip Code*/
            var twoAndSixCategoryZipCode = document.getElementById("two-and-six-category-zip");
            var twoAndSixCategoryZipCodeValue = twoAndSixCategoryZipCode.value.trim();
            var twoAndSixCategoryZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(twoAndSixCategoryZipCodeValue == null || twoAndSixCategoryZipCodeValue == "" || !twoAndSixCategoryZipCodeValue.match(twoAndSixCategoryZipCodeRegEx)){
                twoAndSixCategoryZipCode.placeholder = "please Enter Correct Zip Code";
                twoAndSixCategoryZipCode.value = "";
                twoAndSixCategoryZipCode.classList.add("placeholder_color_border");
                twoAndSixCategoryZipCode.focus();
                twoAndSixCategoryZipCode.onclick = function(){
                    twoAndSixCategoryZipCode.classList.remove("placeholder_color_border");
                    twoAndSixCategoryZipCode.value = twoAndSixCategoryZipCodeValue;
                }
                twoAndSixCategoryZipCode.onkeydown = function(){
                    twoAndSixCategoryZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for twoAndSixCategory Zip Code*/
            /*  for twoAndSixCategory Description */
                var twoAndSixCategoryDescription = document.getElementById("two-and-six-category-description");
                var twoAndSixCategoryDescriptionValue = twoAndSixCategoryDescription.value.trim();
                if(twoAndSixCategoryDescriptionValue == null || twoAndSixCategoryDescriptionValue == "" || twoAndSixCategoryDescriptionValue.length < 3){
                    twoAndSixCategoryDescription.placeholder = "please Enter Atleast Three Characters";
                    twoAndSixCategoryDescription.value = "";
                    twoAndSixCategoryDescription.classList.add("placeholder_color_border");
                    twoAndSixCategoryDescription.focus();
                    twoAndSixCategoryDescription.onclick = function(){
                        twoAndSixCategoryDescription.classList.remove("placeholder_color_border");
                        twoAndSixCategoryDescription.value = twoAndSixCategoryDescriptionValue;
                    }
                    twoAndSixCategoryDescription.onkeydown = function(){
                        twoAndSixCategoryDescription.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for twoAndSixCategory Description */
            /* for twoAndSixCategory images */
            var twoAndSixCategoryImageFile = document.getElementById("two-and-six-category-image-file");
            var twoAndSixCategoryImageFileValue = twoAndSixCategoryImageFile.value;
            var twoAndSixCategoryImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;  
            if(!twoAndSixCategoryImageFileValue.match(twoAndSixCategoryImageRegex)){
                twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files");
                twoAndSixCategoryImageFile.title = "Please select correct extensions";
                twoAndSixCategoryImageFile.focus();
                twoAndSixCategoryImageFile.onclick = function(){
                    twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files");
                }
                return false;
            }
            var twoAndSixCategoryImageFileLength = twoAndSixCategoryImageFile.files.length;
            if (twoAndSixCategoryImageFileLength > 3){
                twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files-two");
                twoAndSixCategoryImageFile.title = "Please Upload only three images";
                twoAndSixCategoryImageFile.focus();
                twoAndSixCategoryImageFile.onclick = function(){
                    twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files-two");
                }
            
                return false;
            }
            var twoAndSixCategoryImageFileSize = twoAndSixCategoryImageFile.files[0].size;
            if( ( twoAndSixCategoryImageFileSize /1024 /1024) > 1){
                twoAndSixCategoryImageFile.classList.add("placeholder_color_border", "image-files-one");
                twoAndSixCategoryImageFile.title = "Your File Should Be less Than 1 MB";
                twoAndSixCategoryImageFile.focus();
                twoAndSixCategoryImageFile.onclick = function(){
                    twoAndSixCategoryImageFile.classList.remove("placeholder_color_border", "image-files-one");
                }
                return false;
            }
              
           /*END  for twoAndSixCategory images*/
        }else if(document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 38 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 39 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 40 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 41 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 42 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 43 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 44 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 45 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 46 || document.getElementById("subcategories").options[document.getElementById("subcategories").selectedIndex].value == 47){
    
            /*upcomingEvents title*/
            var upcomingEventsTitle = document.getElementById("upcomig-events-title");
            var upcomingEventsTitleValue = upcomingEventsTitle.value.trim();
            if(upcomingEventsTitleValue == null || upcomingEventsTitleValue == ""){
                upcomingEventsTitle.placeholder = "Please Fill This Field";
                upcomingEventsTitle.classList.add("placeholder_color_border");
                upcomingEventsTitle.focus();
                upcomingEventsTitle.onclick = function(){
                    upcomingEventsTitle.classList.remove("placeholder_color_border");
                }
                upcomingEventsTitle.onkeydown = function(){
                    upcomingEventsTitle.classList.remove("placeholder_color_border");
                }
                return false;
            }else if(upcomingEventsTitleValue.length < 4){
                upcomingEventsTitle.placeholder = "Please Enter Atleast Four Characters";
                upcomingEventsTitle.classList.add("placeholder_color_border");
                upcomingEventsTitle.value = "";
                upcomingEventsTitle.focus();
                upcomingEventsTitle.onclick = function(){
                    upcomingEventsTitle.classList.remove("placeholder_color_border");
                    upcomingEventsTitle.value = upcomingEventsTitleValue;
                }
                upcomingEventsTitle.onkeydown = function(){
                    upcomingEventsTitle.classList.remove("placeholder_color_border");
                   
                }
                return false;
            }
            /*END upcomingEvents title*/
            /* upcomingEvents email and mobile*/
                var upcomingEventsEmail = document.getElementById("upcomig-events-email");
                var upcomingEventsMobile = document.getElementById("upcomig-events-mobile");
                var upcomingEventsEmailValue = upcomingEventsEmail.value.trim();
                var upcomingEventsMobileValue = upcomingEventsMobile.value.trim();
                var upcomingEventsEmailValueLength = upcomingEventsEmailValue.length;
                var upcomingEventsMobileValueLength = upcomingEventsMobileValue.length;
                var upcomingEventsEmailRegEx = /^([a-z0-9.]+)@([a-z]+)\.([a-z]+)$/;
                var upcomingEventsmobileRegEx = /^(\d{3})-(\d{3})-(\d{4})$/;
        
                if(!upcomingEventsEmailValueLength && !upcomingEventsMobileValueLength){
                upcomingEventsEmail.placeholder = "Please Fill Email Address Or Mobile Number";
                upcomingEventsMobile.placeholder = "Please Fill Email Address Or Mobile Number";
                upcomingEventsEmail.classList.add("placeholder_color_border");
                upcomingEventsMobile.classList.add("placeholder_color_border");
                upcomingEventsEmail.focus();
                upcomingEventsMobile.focus();
                upcomingEventsEmail.onclick = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                upcomingEventsEmail.onkeydown = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                upcomingEventsMobile.onclick = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                upcomingEventsMobile.onkeydown = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                return false;
                }else if(!upcomingEventsEmailValue.match(upcomingEventsEmailRegEx) && !upcomingEventsMobileValue.match(upcomingEventsmobileRegEx)){
                
                upcomingEventsEmail.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                upcomingEventsMobile.placeholder = "Please Enter Mobile Number Or Email Address Correctly";
                upcomingEventsEmail.classList.add("placeholder_color_border");
                upcomingEventsMobile.classList.add("placeholder_color_border");
                upcomingEventsEmail.value = "";
                upcomingEventsMobile.value = "";
                upcomingEventsEmail.focus();
                upcomingEventsMobile.focus();
                upcomingEventsEmail.onclick = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                    upcomingEventsEmail.value = upcomingEventsEmailValue;
                    upcomingEventsMobile.value = upcomingEventsMobileValue;
                }
                upcomingEventsEmail.onkeydown = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                upcomingEventsMobile.onclick = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                    upcomingEventsEmail.value = upcomingEventsEmailValue;
                    upcomingEventsMobile.value = upcomingEventsMobileValue;
                }
                upcomingEventsMobile.onkeydown = function(){
                    upcomingEventsEmail.classList.remove("placeholder_color_border");
                    upcomingEventsMobile.classList.remove("placeholder_color_border");
                }
                
                return false;
                }
                
            /* END upcomingEvents email and mobile*/
            /*for upcomingEvents price*/
            var upcomingEventsPrice = document.getElementById("upcomig-events-price");
            var upcomingEventsPriceValue = upcomingEventsPrice.value.trim();
            var upcomingEventsPriceRegEx = /^(?!.*(,,|,\.|\.,|\.\.))[\d.,]+$/;
            if(upcomingEventsPriceValue == null || upcomingEventsPriceValue == ""){
    
            } else{
                if(!upcomingEventsPriceValue.match(upcomingEventsPriceRegEx)){    
                    upcomingEventsPrice.placeholder = "please Enter correctly  ";
                    upcomingEventsPrice.value = "";
                    upcomingEventsPrice.classList.add("placeholder_color_border");
                    upcomingEventsPrice.focus();
                    upcomingEventsPrice.onclick = function(){
                        upcomingEventsPrice.classList.remove("placeholder_color_border");
                        upcomingEventsPrice.value = upcomingEventsPriceValue;
                    }
                    upcomingEventsPrice.onkeydown = function(){
                        upcomingEventsPrice.classList.remove("placeholder_color_border");
                        
                    }
                    return false;        
            
                }    
            }
            /*END for upcomingEvents price*/
            /* upcomingEvents owner name*/
               
            var upcomingEventsOwnerName = document.getElementById("upcomig-events-ownername");
            var upcomingEventsOwnerNameValue = upcomingEventsOwnerName.value.trim(); 
            var upcomingEventsOwnerNameRegEx = /^([a-zA-Z ']){2}/;
            if(upcomingEventsOwnerNameValue == null || upcomingEventsOwnerNameValue == ""){
    
            }else{    
                     if(!upcomingEventsOwnerNameValue.match(upcomingEventsOwnerNameRegEx)){
                        upcomingEventsOwnerName.placeholder ="please Enter Organizer  Name Correctly";
                        upcomingEventsOwnerName.classList.add("placeholder_color_border");
                        upcomingEventsOwnerName.value ="";
                        upcomingEventsOwnerName.focus();
                        upcomingEventsOwnerName.onclick = function(){
                            upcomingEventsOwnerName.classList.remove("placeholder_color_border");
                            upcomingEventsOwnerName.value = upcomingEventsOwnerNameValue;
                        }
                        upcomingEventsOwnerName.onkeydown = function(){
                            upcomingEventsOwnerName.classList.remove("placeholder_color_border");
                        }
                        return false;
                    }
                }    
            
            /* END upcomingEvents owner name*/
            /*  upcomingEvents location*/
            /* for upcomingEvents  location*/
            var upcomingEventsLocation = document.getElementById("upcomig-events-location");
            var upcomingEventsLocationValue = upcomingEventsLocation.value.trim();
            var upcomingEventsLocationRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var upcomingEventsLocationRegex = /([a-zA-Z0-9-. ]+)?/;
            if(!upcomingEventsLocationValue.match(upcomingEventsLocationRegex) || upcomingEventsLocationValue.match(upcomingEventsLocationRegex1)){
                upcomingEventsLocation.placeholder = "please Enter Correct Location";
                upcomingEventsLocation.value = "";
                upcomingEventsLocation.classList.add("placeholder_color_border");
                upcomingEventsLocation.focus();
                upcomingEventsLocation.onclick = function(){
                    upcomingEventsLocation.classList.remove("placeholder_color_border");
                    upcomingEventsLocation.value = upcomingEventsLocationValue;
                }
                upcomingEventsLocation.onkeydown = function(){
                    upcomingEventsLocation.classList.remove("placeholder_color_border");
                    
                }
                return false;
        
                
            }
            /* END for upcomingEvents  location*/
            /* for upcomingEvents Street*/
            var upcomingEventsStreet = document.getElementById("upcomig-events-street");
            var upcomingEventsStreetValue = upcomingEventsStreet.value.trim();
            var upcomingEventsStreetRegex1 = /([_+!~@$%\^&*=()?\/"':;<>|])/;
            var upcomingEventsStreetRegex = /([a-zA-Z0-9 .-]+)?/;
            if(!upcomingEventsStreetValue.match(upcomingEventsStreetRegex) || upcomingEventsStreetValue.match(upcomingEventsStreetRegex1)){
                upcomingEventsStreet.placeholder = "please Enter Correct Street";
                upcomingEventsStreet.value = "";
                upcomingEventsStreet.classList.add("placeholder_color_border");
                upcomingEventsStreet.focus();
                upcomingEventsStreet.onclick = function(){
                    upcomingEventsStreet.classList.remove("placeholder_color_border");
                    upcomingEventsStreet.value = upcomingEventsStreetValue;
                }
                upcomingEventsStreet.onkeydown = function(){
                    upcomingEventsStreet.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for upcomingEvents Street*/
            /* for upcomingEvents State and city*/        
        
            /* END for upcomingEvents State and city*/
            /* for upcomingEvents Zip Code*/
            var upcomingEventsZipCode = document.getElementById("upcomig-events-zip");
            var upcomingEventsZipCodeValue = upcomingEventsZipCode.value.trim();
            var upcomingEventsZipCodeRegEx = /(^(631)+\d{2}$)/;
            if(upcomingEventsZipCodeValue == null || upcomingEventsZipCodeValue == "" || !upcomingEventsZipCodeValue.match(upcomingEventsZipCodeRegEx)){
                upcomingEventsZipCode.placeholder = "please Enter Correct Zip Code";
                upcomingEventsZipCode.value = "";
                upcomingEventsZipCode.classList.add("placeholder_color_border");
                upcomingEventsZipCode.focus();
                upcomingEventsZipCode.onclick = function(){
                    upcomingEventsZipCode.classList.remove("placeholder_color_border");
                    upcomingEventsZipCode.value = upcomingEventsZipCodeValue;
                }
                upcomingEventsZipCode.onkeydown = function(){
                    upcomingEventsZipCode.classList.remove("placeholder_color_border");
                    
                }
                return false;
            }
            /* END for upcomingEvents Zip Code*/
            /*  for upcomingEvents Description */
                var upcomingEventsDescription = document.getElementById("upcomig-events-description");
                var upcomingEventsDescriptionValue = upcomingEventsDescription.value.trim();
                if(upcomingEventsDescriptionValue == null || upcomingEventsDescriptionValue == "" || upcomingEventsDescriptionValue.length < 3){
                    upcomingEventsDescription.placeholder = "please Enter Atleast Three Characters";
                    upcomingEventsDescription.value = "";
                    upcomingEventsDescription.classList.add("placeholder_color_border");
                    upcomingEventsDescription.focus();
                    upcomingEventsDescription.onclick = function(){
                        upcomingEventsDescription.classList.remove("placeholder_color_border");
                        upcomingEventsDescription.value = upcomingEventsDescriptionValue;
                    }
                    upcomingEventsDescription.onkeydown = function(){
                        upcomingEventsDescription.classList.remove("placeholder_color_border");
                        
                    }
                    return false;
                }
            /* END for upcomingEvents Description */
            /* for upcomingEvents images */
            var upcomingEventsImageFile = document.getElementById("upcomig-events-image-file");
            var upcomingEventsImageFileValue = upcomingEventsImageFile.value;
            var upcomingEventsImageRegex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;  
            if(!upcomingEventsImageFileValue.match(upcomingEventsImageRegex)){
                upcomingEventsImageFile.classList.add("placeholder_color_border", "image-files");
                upcomingEventsImageFile.title = "Please select correct extensions";
                upcomingEventsImageFile.focus();
                upcomingEventsImageFile.onclick = function(){
                    upcomingEventsImageFile.classList.remove("placeholder_color_border", "image-files");
                }
                return false;
            }
            var upcomingEventsImageFileLength = upcomingEventsImageFile.files.length;
            if (upcomingEventsImageFileLength > 3){
                upcomingEventsImageFile.classList.add("placeholder_color_border", "image-files-two");
                upcomingEventsImageFile.title = "Please Upload only three images";
                upcomingEventsImageFile.focus();
                upcomingEventsImageFile.onclick = function(){
                    upcomingEventsImageFile.classList.remove("placeholder_color_border", "image-files-two");
                }
            
                return false;
            }
            var upcomingEventsImageFileSize = upcomingEventsImageFile.files[0].size;
            if( ( upcomingEventsImageFileSize /1024 /1024) > 1){
                upcomingEventsImageFile.classList.add("placeholder_color_border", "image-files-one");
                upcomingEventsImageFile.title = "Your File Should Be less Than 1 MB";
                upcomingEventsImageFile.focus();
                upcomingEventsImageFile.onclick = function(){
                    upcomingEventsImageFile.classList.remove("placeholder_color_border", "image-files-one");
                }
                return false;
            }
              
           /*END  for upcomingEvents images*/
           /* for upcomingEvents  url*/
           var upcomingEventsUrl = document.getElementById("upcomig-events-url");               
           var upcomingEventsUrlValue = upcomingEventsUrl.value.trim();               
           var upcomingEventsUrlRegex1 =/(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
           var upcomingEventsUrlRegex2 =/^((https?):\/\/)?(www\.)([a-zA-Z0-9-.+]+)\.([a-z]+)\/?/;
           if(upcomingEventsUrlValue == null || upcomingEventsUrlValue == "" ){
               
              
           }
           else{
               if(!upcomingEventsUrlValue.match(upcomingEventsUrlRegex1)){
                   upcomingEventsUrl.placeholder = "Please Enter www.";
                   upcomingEventsUrl.value = "";
                   upcomingEventsUrl.classList.add("placeholder_color_border");
                   upcomingEventsUrl.focus();
                   upcomingEventsUrl.onclick = function(){
                       upcomingEventsUrl.classList.remove("placeholder_color_border");
                       upcomingEventsUrl.value = upcomingEventsUrlValue;
                   }
                   upcomingEventsUrl.onkeydown = function(){
                       upcomingEventsUrl.classList.remove("placeholder_color_border");
                       
                   }
                   return false;
               }else if(!upcomingEventsUrlValue.match(upcomingEventsUrlRegex2)){
                   upcomingEventsUrl.placeholder = "Please Enter http or https correctly";
                   upcomingEventsUrl.value = "";
                   upcomingEventsUrl.classList.add("placeholder_color_border");
                   upcomingEventsUrl.focus();
                   upcomingEventsUrl.onclick = function(){
                       upcomingEventsUrl.classList.remove("placeholder_color_border");
                       upcomingEventsUrl.value = upcomingEventsUrlValue;
                   }
                   upcomingEventsUrl.onkeydown = function(){
                       upcomingEventsUrl.classList.remove("placeholder_color_border");
                       
                   }
                   return false;
               }
           }                 
           /* END for upcomingEvents  url*/
    
           /*for upcomingEvents start time and end time */
            var fullDayEventCheckBox = document.getElementById("full-day-event-check-box");
            var addEndTimeEventCheckBox = document.getElementById("add-end-day-event-check-box");
            var upComingEventStartDate = document.getElementById("upcomig-events-start-date");
            var upComingEventStartDateValue = upComingEventStartDate.value;
            var upComingEventStartTime = document.getElementById("upcomig-events-start-time");
            var upComingEventStartTimeValue = upComingEventStartTime.value;
            var upComingEventEndDate = document.getElementById("upcomig-events-end-date");
            var upComingEventEndDateValue = upComingEventEndDate.value;
            var upComingEventEndTime = document.getElementById("upcomig-events-end-time");
            var upComingEventEndTimeValue = upComingEventEndTime.value;
    
            var fullDayEventErrorMessage = document.getElementById("full-day-event-error-message");
            if(fullDayEventCheckBox.checked){
               if(upComingEventStartDateValue == null || upComingEventStartDateValue == ""){
                    fullDayEventErrorMessage.innerHTML = "Please Fill  Start Date";
                    fullDayEventErrorMessage.classList.add("error_msg_box");
                    upComingEventStartDate.classList.add("placeholder_color_border");
                    upComingEventStartDate.focus();
                    upComingEventStartDate.onclick = function(){
                        fullDayEventErrorMessage.innerHTML = "";
                        fullDayEventErrorMessage.classList.remove("error_msg_box");
                        upComingEventStartDate.classList.remove("placeholder_color_border");
                    }
                    return false;
               }
            }else {
                if(upComingEventStartDateValue == null || upComingEventStartDateValue == "" || upComingEventStartTimeValue == null || upComingEventStartTimeValue == ""){
                    fullDayEventErrorMessage.innerHTML = "Please Fill Start Date and Start Time ";
                    fullDayEventErrorMessage.classList.add("error_msg_box");
                    upComingEventStartDate.classList.add("placeholder_color_border");
                    upComingEventStartTime.classList.add("placeholder_color_border");
                    upComingEventStartDate.focus();
                    upComingEventStartDate.onclick = function(){
                        fullDayEventErrorMessage.innerHTML = "";
                        fullDayEventErrorMessage.classList.remove("error_msg_box");
                        upComingEventStartDate.classList.remove("placeholder_color_border");
                        upComingEventStartTime.classList.remove("placeholder_color_border");
                    }
                    upComingEventStartTime.onclick = function(){
                        fullDayEventErrorMessage.innerHTML = "";
                        fullDayEventErrorMessage.classList.remove("error_msg_box");
                        upComingEventStartDate.classList.remove("placeholder_color_border");
                        upComingEventStartTime.classList.remove("placeholder_color_border");
                    }
                    return false;
                } 
            }
            if(addEndTimeEventCheckBox.checked){
                if(upComingEventEndDateValue == null || upComingEventEndDateValue == "" || upComingEventEndTimeValue == null || upComingEventEndTimeValue == ""){
                    fullDayEventErrorMessage.innerHTML = "Please Fill End Date and End Time Also ";
                    fullDayEventErrorMessage.classList.add("error_msg_box");
                    upComingEventEndDate.classList.add("placeholder_color_border");
                    upComingEventEndTime.classList.add("placeholder_color_border");
                    upComingEventEndDate.focus();
                    upComingEventEndDate.onclick = function(){
                        fullDayEventErrorMessage.innerHTML = "";
                        fullDayEventErrorMessage.classList.remove("error_msg_box");
                        upComingEventEndDate.classList.remove("placeholder_color_border");
                        upComingEventEndTime.classList.remove("placeholder_color_border");
                    }
                    upComingEventEndTime.onclick = function(){
                        fullDayEventErrorMessage.innerHTML = "";
                        fullDayEventErrorMessage.classList.remove("error_msg_box");
                        upComingEventEndDate.classList.remove("placeholder_color_border");
                        upComingEventEndTime.classList.remove("placeholder_color_border");
                    }
                    return false;
                }
             }
    
           /*END for upcomingEvents start time and end time */
    
        }
         
    
        var formSubmitAndReset = document.getElementsByName("myform")[0];
        formSubmitAndReset.submit();
        formSubmitAndReset.reset();
        return false;
    
           
        
        
        
    }
    //validations ends here


    function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('.stlouisCounter').text(500 - len);
        }
      }
    
    
       
    function hideEndTimeEvent(){
   var fullDayEventCheckBox = document.getElementById("full-day-event-check-box");
   var addClickEventHide = document.getElementById("add_end_time_event_bg");
   var addEndDayEventlable =document.getElementById("add-end-day-event-label");
   var formControlDateAndTime = document.getElementsByClassName("form_control_date_and_time");
   var endTimingsCheckBox = document.getElementById("add-end-day-event-check-box");
   var endTimeLastTwo = document.getElementsByClassName("hiding_end_time");
   if(fullDayEventCheckBox.checked == true){
       addEndDayEventlable.style.visibility = "hidden";
       addClickEventHide.style.display ="none";
       endTimingsCheckBox.checked = false;
       for(var i = 0; i < formControlDateAndTime.length;i++){
           formControlDateAndTime[i].value = "";
       }
       for(var i = 0; i < endTimeLastTwo.length;i++){
           endTimeLastTwo[i].style.display = "none";
       }
   }else{
       if(fullDayEventCheckBox.checked == false){
           addEndDayEventlable.style.visibility = "visible";
           addClickEventHide.style.display ="block";
       }
   }
}
    function hideAddTimeEvent(){
        var endTimeLastTwo = document.getElementsByClassName("hiding_end_time");
        if(endTimeLastTwo[0].style.display === "block" || endTimeLastTwo[1].style.display === "block" ){
            endTimeLastTwo[0].style.display = "none";
            endTimeLastTwo[1].style.display = "none";      
        }else{
            
            endTimeLastTwo[0].style.display = "block";        
            endTimeLastTwo[1].style.display = "block";  
        }
    }



    function subCategoryListOne(list){
      
        listingOne = list.options[list.selectedIndex].value;        
        var subCategoryListing = document.getElementById("subcategories"); 
        subCategoryListing.length = 1;        
        switch(listingOne){
            
            case "1":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("tourist places", "1");
                subCategoryListing.options[1].setAttribute("data-show", ".one");
                subCategoryListing.options[2] = new Option("useful places", "2");
                subCategoryListing.options[2].setAttribute("data-show", ".one");
                subCategoryListing.options[3] = new Option("appartments", "3");
                subCategoryListing.options[3].setAttribute("data-show", ".two");
                subCategoryListing.options[4] = new Option("universities", "4");
                subCategoryListing.options[4].setAttribute("data-show", ".three"); 

                
                break;
            case "2":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("temples", "5");
                subCategoryListing.options[1].setAttribute("data-show", ".four");
                subCategoryListing.options[2] = new Option("churches", "6");
                subCategoryListing.options[2].setAttribute("data-show", ".five");
                subCategoryListing.options[3] = new Option("mosques", "7");
                subCategoryListing.options[3].setAttribute("data-show", ".six");
                subCategoryListing.options[4] = new Option("others", "8");
                subCategoryListing.options[4].setAttribute("data-show", ".seven");

                           
                 
                break;
            case "3":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("desi stores", "9");
                subCategoryListing.options[1].setAttribute("data-show", ".eight");
                subCategoryListing.options[2] = new Option("other stores", "10");
                subCategoryListing.options[2].setAttribute("data-show", ".eight");

                       
                break;
            case "4":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("indian", "11");
                subCategoryListing.options[1].setAttribute("data-show", ".eight");
                subCategoryListing.options[2] = new Option("thai", "12");
                subCategoryListing.options[2].setAttribute("data-show", ".eight");
                subCategoryListing.options[3] = new Option("american", "13");
                subCategoryListing.options[3].setAttribute("data-show", ".eight");
                subCategoryListing.options[4] = new Option("italian", "14");
                subCategoryListing.options[4].setAttribute("data-show", ".eight");
                subCategoryListing.options[5] = new Option("mexican", "15");
                subCategoryListing.options[5].setAttribute("data-show", ".eight");

                
                break;   
            case "5":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("doctor clinics", "16");
                subCategoryListing.options[1].setAttribute("data-show", ".eight");
                subCategoryListing.options[2] = new Option("hospitals", "17");
                subCategoryListing.options[2].setAttribute("data-show", ".eight");
                subCategoryListing.options[3] = new Option("diagnostics labs", "18");
                subCategoryListing.options[3].setAttribute("data-show", ".eight");
                subCategoryListing.options[4] = new Option("physiotherapy", "19");
                subCategoryListing.options[4].setAttribute("data-show", ".eight");            
                subCategoryListing.options[5] = new Option("urgent cares", "20");
                subCategoryListing.options[5].setAttribute("data-show", ".eight");   
                
                
                break;
            case "6":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("hindi", "21");
                subCategoryListing.options[1].setAttribute("data-show", ".nine");
                subCategoryListing.options[2] = new Option("telugu", "22");
                subCategoryListing.options[2].setAttribute("data-show", ".nine");
                subCategoryListing.options[3] = new Option("english", "23");
                subCategoryListing.options[3].setAttribute("data-show", ".nine");
                subCategoryListing.options[4] = new Option("tamil", "24");
                subCategoryListing.options[4].setAttribute("data-show", ".nine");
                subCategoryListing.options[5] = new Option("malayanam", "25");
                subCategoryListing.options[5].setAttribute("data-show", ".nine");

                
                break;
            case "8":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("part time", "28");
                subCategoryListing.options[1].setAttribute("data-show", ".ten");
                subCategoryListing.options[2] = new Option("full time", "29");
                subCategoryListing.options[2].setAttribute("data-show", ".ten");   
                
                
                break;
            case "9":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("accommodations", "30");
                subCategoryListing.options[1].setAttribute("data-show", ".two");
                subCategoryListing.options[2] = new Option("child care", "31");
                subCategoryListing.options[2].setAttribute("data-show", ".two");
                subCategoryListing.options[3] = new Option("catering", "32");
                subCategoryListing.options[3].setAttribute("data-show", ".eleven");
                subCategoryListing.options[4] = new Option("for sell", "33");
                subCategoryListing.options[4].setAttribute("data-show", ".two");

                
                break; 
            case "10":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("lawyer", "34");
                subCategoryListing.options[1].setAttribute("data-show", ".twelve");
                subCategoryListing.options[2] = new Option("insurance agents", "35");
                subCategoryListing.options[2].setAttribute("data-show", ".twelve");        
                subCategoryListing.options[3] = new Option("travel agents", "36");
                subCategoryListing.options[3].setAttribute("data-show", ".twelve");
                subCategoryListing.options[4] = new Option("accountant", "37");
                subCategoryListing.options[4].setAttribute("data-show", ".twelve");
                
                
                break;
            case "11":
                subCategoryListing.options[0] = new Option("Please select sub category", "0");
                subCategoryListing.options[0].setAttribute("selected", "selected");
                subCategoryListing.options[1] = new Option("temple events", "38");
                subCategoryListing.options[1].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[2] = new Option("Mosque events", "39");
                subCategoryListing.options[2].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[3] = new Option("church events", "40");
                subCategoryListing.options[3].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[4] = new Option("movie events", "41");
                subCategoryListing.options[4].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[5] = new Option("arts and entertainment events", "42");
                subCategoryListing.options[5].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[6] = new Option("music events", "43");
                subCategoryListing.options[6].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[7] = new Option("sports events", "44");
                subCategoryListing.options[7].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[8] = new Option("dance events", "45");
                subCategoryListing.options[8].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[9] = new Option("universities events", "46");
                subCategoryListing.options[9].setAttribute("data-show", ".thirteen");
                subCategoryListing.options[10] = new Option("others events", "47");
                subCategoryListing.options[10].setAttribute("data-show", ".thirteen");
                break;            
        }
        return true;
    }
    
    
    
  