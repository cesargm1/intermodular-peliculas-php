const button = document.querySelector(".buy");
const modal = document.querySelector(".modal");
const span = document.querySelector(".close");

button.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }