//selecting all required elements
var dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("#academic_btn_visible"),
file_name = dropArea.querySelector("#file_name"),
input = dropArea.querySelector("#academic_qualification_upload"),
dropArea_exp = document.querySelector(".drag-area_exp"),
dragText_exp = dropArea_exp.querySelector(".header_exp"),
button_exp = dropArea_exp.querySelector("#experience_btn_visible"),
file_name_exp = dropArea_exp.querySelector("#file_name_exp"),
input_exp = dropArea_exp.querySelector("#previous_experience_upload");

let file; //this is a global variable and we'll use it inside multiple functions

let file_exp; //this is a global variable and we'll use it inside multiple functions



button.onclick = ()=>{
  input.click(); //if user click on the button then the input also clicked
};
button_exp.onclick = ()=>{
  input_exp.click(); //if user click on the button then the input also clicked
};

input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
  showFile(file,dropArea,dragText,file_name); //calling function
});
input_exp.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file_exp = this.files[0];
  dropArea_exp.classList.add("active");
  showFile(file_exp,dropArea_exp,dragText_exp,file_name_exp); //calling function
});


//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});
//If user Drag File Over DropArea
dropArea_exp.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea_exp.classList.add("active");
  dragText_exp.textContent = "Release to Upload File";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});
//If user leave dragged File from DropArea
dropArea_exp.addEventListener("dragleave", ()=>{
  dropArea_exp.classList.remove("active");
  dragText_exp.textContent = "Drag & Drop to Upload File";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = event.dataTransfer.files[0];
  input.files = event.dataTransfer.files;
  showFile(file,dropArea, dragText,file_name); //calling function
});
//If user drop File on DropArea
dropArea_exp.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file_exp = event.dataTransfer.files[0];
  input_exp.files =  event.dataTransfer.files;
  showFile(file_exp,dropArea_exp, dragText_exp, file_name_exp); //calling function
});



function showFile(file,dropArea, dragText, file_name_div){
  let fileType = file.type; //getting selected file type
  let validExtensions = ["application/pdf","image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
     // let fileURL = fileReader.result; //passing user file source in fileURL variable
      let imgTag = `<i class="text-success fas fa-check-circle"></i><span>${file.name}`; //creating an img tag and passing user selected file source inside src attribute
     
      file_name_div.innerHTML = imgTag;
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("This is not an Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}
