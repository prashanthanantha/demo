//file preview multiple
window.onload = function(){
    var fileUpload = document.getElementById("edit-image");
    
    fileUpload.onchange =function(){
       
      
        if(typeof(FileReader) !== "undefined" ){
                                            
            var editimagePreview = document.getElementById("edit-image-preview");
            if(editimagePreview  === null){
                var newDiv = document.createElement("DIV");
                newDiv.classList.add("edit_image_preview_right_bg");
                newDiv.id = "edit-image-preview";
                var parentDiv = document.getElementById("edit_image_preview_bg");
                parentDiv.insertBefore(newDiv, parentDiv.childNodes[2]);
                var editimagePreview = document.getElementById("edit-image-preview");
                editimagePreview.innerHTML="";
            }else {
                editimagePreview.innerHTML="";
                
            }           
            var fileUploadregex = /(.*?)\.(jpg|bmp|jpeg|png|svg|gif|JPG)$/;
            for(var i = 0; i <  fileUpload.files.length; i++){
                var uplaodFile = fileUpload.files[i];
                
                if(fileUpload.files.length > 3){
                    fileUpload.classList.add("new_input_error_bg", "image-files-two");
                    fileUpload.title = "Please Upload only three images";
                    fileUpload.focus();
                    fileUpload.onclick = function(){
                        fileUpload.classList.remove("new_input_error_bg", "image-files-two");
                    }
                    return false;
                }                                                                  
                if(fileUploadregex.test(uplaodFile.name.toLowerCase())){
                    
                    var fileReader = new FileReader()
                    fileReader.onload = function(e){
                        var imageOutter = document.createElement("div");
                        imageOutter.className = "upload_image_wrapper";
                        editimagePreview.insertBefore(imageOutter, editimagePreview.childNodes[0]);
                        var fileUploadImg = document.createElement("IMG");
                        fileUploadImg.width = "100";
                        fileUploadImg.height = "100";
                        fileUploadImg.classList.add("new_image");
                        imageOutter.style.marginRight = "15px";
                        fileUploadImg.src = e.target.result;
                        imageOutter.appendChild(fileUploadImg);    
                        var deleteImageButton = document.createElement("Button");
                        deleteImageButton.innerHTML = "&#215;"                        
                        deleteImageButton.className ="delete_upload_image";
                        deleteImageButton.type = "button";
                        imageOutter.insertBefore(deleteImageButton, imageOutter.childNodes[1]);
                        
                    }
                    fileReader.readAsDataURL(uplaodFile);
                }                                     
                else
                if(!fileUploadregex.test(uplaodFile.name.toLowerCase())){
                    var el = document.getElementById( 'edit-image-preview' );
                    el.parentNode.removeChild( el );                   
                    fileUpload.classList.add("new_input_error_bg", "image-files");
                    fileUpload.title = "We Accept Only jpg, jpeg, png, svg, gif And JPG Files Only";
                    fileUpload.focus();
                    fileUpload.onclick = function(){
                        fileUpload.classList.remove("new_input_error_bg", "image-files");
                    }
                    return false;
                }
                                

            }
            
        }
        else{
            alert("This browser does not support HTML5 FileReader.");
        }
    }


}

var imageList = document.querySelector(".edit_image_preview_right_bg");
imageList.addEventListener("click", function(image){
    var imagedeleting = image.target;
    var imageWrapper;
    var imageWrapperOutside;
    if(imagedeleting.classList.contains("delete_upload_image")){
       
        imageWrapper = imagedeleting.parentNode;
        imageWrapperOutside = imageWrapper.parentNode;
        imageWrapperOutside.removeChild(imageWrapper);
    }
});
