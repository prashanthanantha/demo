var searchButton = document.querySelector(".new_header_search_box_mobile_bg");
var searchBoxForm = document.querySelector(".new_header_search_box_desktop_bg");
function openSearchBoxInMobile(){
    searchBoxForm.classList.toggle("hidden-xs");
}
searchButton.addEventListener("click", openSearchBoxInMobile);


//accordion 
var accordionButton = document.getElementsByClassName("accordion_button");
var accordionContent = document.getElementsByClassName("accordion_content");
for (i = 0; i < accordionButton.length; i++){
    
    accordionButton[i].onclick = function(){
       
        var setClasses = !this.classList.contains('is-open');
        setClass(accordionButton, 'is-open', 'remove');
        setClass(accordionContent, 'open', 'remove');
        if (setClasses) {
            this.classList.toggle("is-open");
            this.nextElementSibling.classList.toggle("open");
        }                
    }
    
}
function setClass(els, className, fnName) {
    for (var i = 0; i < els.length; i++) {
        els[i].classList[fnName](className);
    }
}

//navbar
var navBarBars = document.querySelector(".nav_bar_button_bg");
var navBarCloseButton = document.querySelector(".accordion_close_button");
var sideNavBarBg = document.querySelector(".nav_bar_list_inner_bg");
var sideNavBarOutSide = document.querySelector(".nav_bar_list_bg");
navBarBars.addEventListener("click", function(){    
    sideNavBarBg.style.width = 250 + "px";
    sideNavBarOutSide.classList.add("nav_bar_list_postion_class_fixed") ;
});
navBarCloseButton.addEventListener("click", function(){
    sideNavBarBg.style.width = 0 + "px";
    sideNavBarOutSide.classList.remove("nav_bar_list_postion_class_fixed") ;
});

sideNavBarOutSide.addEventListener("click", function(event) {
    if (event.target === sideNavBarOutSide) {
        sideNavBarBg.style.width = 0 + "px";
        sideNavBarOutSide.classList.remove("nav_bar_list_postion_class_fixed") ;
    }
});

//profile dropdown
function userProfileDropDownOpen(){
    document.querySelector(".new_nav_bar_profile_dropdown").classList.toggle("is_opened");
}
window.addEventListener("mouseup", function(event) {    
    if(event.target.matches(".new_nav_common_class")){
        userProfileDropDownOpen();
    }
    else {     
      var userProfileDetails = document.getElementsByClassName("new_nav_bar_profile_dropdown");
      for (var i = 0; i < userProfileDetails.length; i++) {
        var openedDropDownMenu = !userProfileDetails[i].contains(event.target);
        if (openedDropDownMenu) {
            userProfileDetails[i].classList.remove("is_opened");
        }
      }
    }
});


//two lines ellipses by js


    
function twoLinesEllipsesFunction(description, textValue){    
      
    var twoLinesEllipses = description;    
    twoLinesEllipsesText = twoLinesEllipses;    
    var twoLinesEllipsesSubStr = twoLinesEllipsesText.substr(0, textValue);
    return twoLinesEllipsesSubStr.trim() + "...";
    
}
var descriptions = document.getElementsByClassName("new_user_post_view_all_page_left_side_box_post_details_description");
var titles = document.getElementsByClassName("new_user_post_view_all_page_left_side_box_post_details_heading_link_bg");
for(var i = 0; i < descriptions.length; i++){    
  var desc =  descriptions[i].textContent;
   var totalDesc =  twoLinesEllipsesFunction(desc, 150);    
   descriptions[i].textContent = totalDesc;
    
}
for(var i = 0; i < titles.length; i++){    
    var desc =  titles[i].textContent;
    var totalDesc =  twoLinesEllipsesFunction(desc, 40);    
     titles[i].textContent = totalDesc;
      
  }