function load() {
	const imagenes = [
		"img/carousel/harry_potter.jpg",
		"img/carousel/star_wars.jpg",
		"img/carousel/joker.jpg",
	];

	const TIEMPO_INTERVALO_MILESIMAS_SEG = 1000;
	let posicionActual = 0;
	let $botonRetroceder = document.querySelector(".prev");
	let $botonAvanzar = document.querySelector(".next");
	let $imagen = document.querySelector("#slide__img");
	// let $botonPlay = document.querySelector("#play");
	// let $botonStop = document.querySelector("#stop");
	let intervalo;

	// funcion pasar foto si el array de imagenes supera su capacidad se movera a la posicion 0 si no es asi seguira avanzando
	function pasarFoto() {
		if (posicionActual >= imagenes.length - 1) {
			posicionActual = 0;
		} else {
			posicionActual++;
		}
		renderizarImagen();
	}

	// funcion retroceder foto si el array de imagenes la posicion es menor o igual a 0 la posicion actual de la imagen

	function retrocederFoto() {
		if (posicionActual <= 0) {
			posicionActual = imagenes.length - 1;
		} else {
			posicionActual--;
		}
		renderizarImagen();
	}
}

document.addEventListener("DOMContentLoaded", ready);
