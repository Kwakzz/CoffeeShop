function selectPicture() {
    var input = document.getElementById("upload-button");
    input.addEventListener("change", function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var pictureContainer = document.getElementById("picture-container");
          pictureContainer.style.backgroundImage = "url('" + e.target.result + "')";
        }
        reader.readAsDataURL(this.files[0]);
      }
    });
  }
  
  window.onload = selectPicture;