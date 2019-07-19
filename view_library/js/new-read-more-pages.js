//main image replacement
var newImagePath = document.getElementById("read-more-main-image");
function changeIt(img){
    var imagePath = img;    
    x = imagePath.src;       
    newImagePath.src = x;    
    var currentButton = document.getElementsByClassName("image");
    for(var i = 0; i < currentButton.length; i++){
        currentButton[i].addEventListener("click", function(){
            var currentClass = document.getElementsByClassName("current-image");
            currentClass[0].className = currentClass[0].className.replace(" current-image", "");
            this.className += " current-image";
        });
    }
    
}
function imageLoad(){
    var singleImage = document.getElementsByClassName("current-image");
    var singleImageAnchorTag = document.getElementById("read-more-main-image-anchor-link");
    singleImageSrc = singleImage[0].src;
    singleImageAlt = singleImage[0].alt;
    newImagePath.src = singleImageSrc;
    newImagePath.alt = singleImageAlt;
    singleImageAnchorTag.href = singleImageSrc;
    singleImageAnchorTag.dataset.caption = singleImageAlt;
}imageLoad();


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




