
function checkPassword (event) {
const key1 = document.getElementById("key1").value;
const key2 = document.getElementById("key2").value;

if(key1 !== key2) {
event.preventDefault(); 

const newDiv = document.createElement("div");
newDiv.id = "error-msg";
newDiv.textContent = 'Las contraseñas no coinciden';
newDiv.setAttribute("style", "background-color:red; font-size:1em; padding: 1em ");
document.querySelector("form").appendChild(newDiv);

} 
}
