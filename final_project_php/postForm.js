function showPreview(event){
    
    if(event.target.files.length > 0){
      console.log("called!!");
      document.querySelector("#submit").classList.remove("disabled-button");
      document.querySelector("#submit").classList.add("def-button");
      document.querySelector("#submit").disabled = false;

      var src = URL.createObjectURL(event.target.files[0]);
      console.log(event.target.files[0]);
      var preview = document.getElementById("img-file-preview");
      preview.src = src;
      preview.style.display = "block";
    }
    
  }