function showPreview(event){
    
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      console.log(event.target.files[0]);
      var preview = document.getElementById("img-file-preview");
      preview.src = src;
      preview.style.display = "block";
    }
    
  }