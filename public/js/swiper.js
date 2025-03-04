const swiper = new Swiper(".swiper", {
	// Optional parameters
	direction: "horizontal",
	clickable: true,
	disableOnInteraction: false,

	//loop: true,

	// If we need pagination
	pagination: {
		el: ".swiper-pagination",
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
	},

	// Navigation arrows
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},

	// And if we need scrollbar
	scrollbar: {
		el: ".swiper-scrollbar",
	},

	// autoplay: {
	// 	delay: 5000,
	// },
	//loop: true,

	effect: "cube",
	grabCursor: true,
	cubeEffect: {
	  shadow: true,
	  slideShadows: true,
	  shadowOffset: 20,
	  shadowScale: 0.94,
	},

});


