document.addEventListener("DOMContentLoaded", function () {
	// header scroll
	function checkScroll() {
		const scrollPosition = window.scrollY;
		const blockHeader = document.querySelector('.js--nheader');
		if (blockHeader) {
			if ( scrollPosition>0 ) {
				blockHeader.classList.add('header__fixed')
			} else {
				blockHeader.classList.remove('header__fixed')
			}
		}
	}

	checkScroll()
	window.addEventListener('scroll', function () {
		checkScroll()
	})
	// /header scroll

	// phone mask
	let inputsPhone = document.querySelectorAll(".js--maskphone");
	if (inputsPhone) {
		let maskPhoneInput = new Inputmask("+7 (999) 999 99 99");
		function getMaskInput(inputsPhone) {
			Array.prototype.forEach.call(inputsPhone, function (input) {
				maskPhoneInput.mask(input)
			})
		}
		getMaskInput(inputsPhone)
	}
	
	// fancybox
	Fancybox.bind("[data-fancybox]", {
		// options
	})
	
	// fancybox for modals
	Fancybox.bind("[data-fancybox-html]", {
		autoFocus: false,
		btnTpl : {
			smallBtn : '<div data-fancybox-close class="fancybox-close-small modal-close">Button</div>'
		},
		on: {
			done: (fancybox) => {
				getMaskInput(inputsPhone)
			},
		},
	})

	// custom select	
	let selectCustom = document.querySelectorAll('.js--select');
	if (selectCustom) {
		Array.prototype.forEach.call(selectCustom, function (select) {
			customSelect(select)
		})
	}	
	// /custom select

	// counter cart
	const inputcartCount = document.querySelectorAll('.js--inputcount');
	if (inputcartCount) {
		Array.prototype.forEach.call(inputcartCount, function (inputbox) {
			let btnMinus = inputbox.querySelector('.js--inputcount-minus');
			let btnPlus = inputbox.querySelector('.js--inputcount-plus');
			let thisInput = inputbox.querySelector('.js--inputcount-input');

			// btnMinus.addEventListener('click', function() {
			// 	let inputVal = thisInput.value;
			// 	inputVal = --inputVal
			// 	if (inputVal>=0) {
			// 		thisInput.value = inputVal
			// 	}
			// })

			// btnPlus.addEventListener('click', function() {
				
			// 	let inputVal = thisInput.value;
				// if(inputVal<$(this).parent(".inputcount").find("input").attr("max")){
				// 	inputVal = ++inputVal
				// 	if (inputVal>=0) { 
				// 		thisInput.value = inputVal

				// 	}
				// }
			// })
		})
	}
	// counter cart

	// filter mobile
	const filterSide = document.querySelector('.js--filter');
	const filterSideBtn = document.querySelector('.js--filter-btn-open');
	const filterSideClose = document.querySelector('.js--filter-btn-close');

	if (filterSide) {
		filterSideBtn.onclick = function () {
			filterSide.classList.add('filter-side__opened')
		}
		filterSideClose.onclick = function () {
			filterSide.classList.remove('filter-side__opened')
		}
	}
	// filter mobile

	// sorter
	const sortBtn = document.querySelector('.js--sort-btn');
	const sortBlock = document.querySelector('.js--sort');
	const sortLinks = document.querySelectorAll('.js--sort-link');

	if (sortBlock) {
		sortBtn.onclick = function () {
			sortBlock.classList.toggle('catalog__sort__mobile__opened')
		}
		
		Array.prototype.forEach.call(sortLinks, function (link) {
			link.onclick = function () {
				textLink = link.innerHTML;
				sortBlock.classList.remove('catalog__sort__mobile__opened')
				sortBtn.innerHTML= '<span>'+textLink+'</span>'
			}
		})
	}
	// sorter

	let moreBtns = document.querySelectorAll('.js--more-btn');
	if (moreBtns) {
		Array.prototype.forEach.call(moreBtns, function (btn) {
			btn.onclick = function (event) {
				event.preventDefault();
				let moreParent = this.closest('.js--more-parent');
				let moreBrands = moreParent.querySelectorAll('[data-hide]');

				this.classList.toggle('active')

				Array.prototype.forEach.call(moreBrands, function (brand) {
					brand.classList.toggle('brands__el__hide')
				})

				document.getElementById('tabs').scrollIntoView();
			}
		})
	}

	// input mask phone
	const inputTel = document.querySelectorAll(".js--inputmask");

	if (inputTel) {
		Array.prototype.forEach.call(inputTel, function (input) {
			window.intlTelInput(input, {
				initialCountry: "auto",
				strictMode: true,
				geoIpLookup: callback => {
				  fetch("https://ipapi.co/json", { mode: 'no-cors' })
					.then(res => res.json())
					.then(data => callback(data.country_code))
					.catch(() => callback("ru"));
				}
			})
		})
		
	}
	
	const tabsButtons = document.querySelectorAll('.js--tabs-link');

tabsButtons.forEach(btn => {
	btn.addEventListener('click', (event) => {
		event.preventDefault()
		const prevActiveItem = document.querySelector('.js--tabs-link.active');
		const prevActiveButton = document.querySelector('.js--tabs-item.active');

		if (prevActiveButton) {
			prevActiveButton.classList.remove('active');
		}

		if (prevActiveItem) {
			prevActiveItem.classList.remove('active');
		}
		const nextActiveItemId = `#${btn.getAttribute('data-tab')}`;
		const nextActiveItem = document.querySelector(nextActiveItemId);

		btn.classList.add('active');
		nextActiveItem.classList.add('active');
	})
});
	// filter slider
let btnFaqToSlide = document.getElementsByClassName('js--filter-title');
let y;

for ( y = 0; y < btnFaqToSlide.length; y++) {
    btnFaqToSlide[y].addEventListener("click", function() {
        this.classList.toggle("active")
        let faqContent = this.nextElementSibling;
        if (faqContent.style.maxHeight) {
            faqContent.style.maxHeight = null
        } else {
            faqContent.style.maxHeight = faqContent.scrollHeight + "px";
        }
    })
} 
// filter slider;
	// mobile nav menu
const navBtn = document.querySelector('.js--mobilemenu-btn');
const nav = document.querySelector('.js--mobilemenu');

if (navBtn) {
	navBtn.onclick = function () {
		nav.classList.toggle('mobilemenu__opened');
		navBtn.classList.toggle('active');
		document.body.classList.toggle('no-scroll');

        let popupOpened = document.querySelector('.mobilemenu__popup__opened');
        if (popupOpened) {
            popupOpened.classList.remove('mobilemenu__popup__opened');
        }
	}

	// mobile slide links menu
	let btnToSlide = document.getElementsByClassName('js--mobilemenu-linkslide');
	let i;

	for ( i = 0; i < btnToSlide.length; i++) {
		btnToSlide[i].addEventListener("click", function() {
			let submenu = this.nextElementSibling;
            submenu.classList.add('mobilemenu__popup__opened')
		})
	}
	let btnToClose = document.getElementsByClassName('js--mobilemenu-link-close');
	let y;

	for ( y = 0; y < btnToClose.length; y++) {
		btnToClose[y].addEventListener("click", function() {
			let submenu = this.closest('.mobilemenu__popup');
            submenu.classList.remove('mobilemenu__popup__opened')
		})
	}
    // /mobile slide links menu
};
	const sliderWelcome = document.querySelector('.js--welcome-slider');

if(sliderWelcome) {
	const welcomeSwiper = new Swiper(sliderWelcome, {
		loop: true,
		slidesPerView: 1,
		autoHeight: true,
		spaceBetween: 20,
		effect: 'fade',
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
        autoplay: true,
        pauseOnMouseEnter: true,

        pagination: {
			el: '.js--welcome-pag',
			clickable: true,
			bulletClass: 'slider__pag__bullet',
			bulletActiveClass: 'active'
		}
	})
};
	const sliderPartners = document.querySelector('.js--patners-slider');

if(sliderPartners) {
	const PartnersSwiper = new Swiper(sliderPartners, {
		// autoHeight: true,
		slidesPerView: 2,
		slidesPerGroup: 2,
		spaceBetween: 10,
		grid: {
			rows: 3,
		},

		navigation: {
			disabledClass: 'slider__nav__btn__disable',
			nextEl: '.js--partners-next',
			prevEl: '.js--partners-prev',
		},

		pagination: {
			el: '.js--partners-pag',
			bulletClass: 'slider__pag__bullet',
			bulletActiveClass: 'active',
			clickable: true,
		},

		breakpoints: {
			576: {
				slidesPerView: 3,
				slidesPerGroup: 3,
				spaceBetween: 10,
				grid: {
					rows: 3,
				},
			},
			768: {			  
				slidesPerView: 4,
				slidesPerGroup: 4,
				spaceBetween: 10,
				grid: {
					rows: 3,
				},
			},
			991: {			  
				slidesPerView: 4,
				slidesPerGroup: 4,
				spaceBetween: 40,
				grid: {
					rows: 2,
				},
			},
			1200: {
				slidesPerView: 6,
				slidesPerGroup: 6,
				spaceBetween: 40,
				grid: {
					rows: 1,
				},
			}
		}
	})
};
	const sliderGallery = document.querySelector('.js--gallery-slider');

if(sliderGallery) {
	const gallerySwiper = new Swiper(sliderGallery, {
		loop: true,
		slidesPerView: 1,
        slidesPerGroup: 1,
		autoHeight: true,
		spaceBetween: 10,
        
        breakpoints: {
			991: {			  
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 40,
			}
		},

        pagination: {
			el: '.js--gallery-pag',
			clickable: true,
			bulletClass: 'slider__pag__bullet',
			bulletActiveClass: 'active'
		},

        navigation: {
			disabledClass: 'slider__nav__btn__disable',
			nextEl: '.js--gallery-next',
			prevEl: '.js--gallery-prev',
		},
	})
};
	// card sliders
const sliderCard = document.querySelector('.js--card-slider');
const sliderCardTambs = document.querySelector('.js--cardtambs-slider');
const tambs = document.querySelectorAll('.card__img__tambs__pic');

if (tambs.length > 4) {
	document.querySelector('.card__img__tambs__nav').classList.add('active')
}

// const pics = document.querySelectorAll('.js--card-zoom');
// const picsOptions = {
//     panMode: 'mousemove',
//     mouseMoveFactor: 1.25,
//     click: false,
//     wheel: false,
// }

// pics.forEach((pic) => {
//     const panzoom = new Panzoom(pic, picsOptions)
// 	pic.addEventListener("mouseenter", (event) => {
//         if (!event.buttons) {
//             panzoom.zoomTo(3); // число - во сколько раз увеличивать изображение
//         }
//     })
//     pic.addEventListener("mouseleave", () => {
//         panzoom.zoomToFit();
//     })
// })

if(sliderCard && sliderCardTambs) {
    
	const CardTambsSwiper = new Swiper(sliderCardTambs, {
		loop: false,
		slidesPerView: 4,
		autoHeight: true,
		spaceBetween: 20,
        direction: "vertical",
        watchSlidesProgress: true,
	})

	const CardSwiper = new Swiper(sliderCard, {
		loop: false,
		slidesPerView: 1,
		autoHeight: true,
		spaceBetween: 0,
		effect: 'fade',

		pagination: {
			el: '.js--card-slider-pag',
			bulletClass: 'card__img__slider__pag__bullet',
			bulletActiveClass: 'active',
			clickable: true,
		},

		navigation: {
			disabledClass: 'disable',
			nextEl: '.js--cardtambs-slider--next',
			prevEl: '.js--cardtambs-slider--prev',
		},

        thumbs: {
            swiper: CardTambsSwiper,
        },
	})
}

// /card sliders;



const map2 = document.querySelector('.map');


$(".map").each(function(index, el){
	
	const koord =$(el).data('koord').split(',');
	const adres = $(el).data('adres');
	ymaps.ready(init);
	function init() {
		let mapContacts = new ymaps.Map(el, {
			center: [parseFloat(koord[0]), parseFloat(koord[1])],
			zoom: 15,
			controls: [
				'zoomControl'
			],
			zoomMargin: [20]
		});

		// Точка на карте
		let PlacemarkContacts = new ymaps.Placemark(
			[parseFloat(koord[0]), parseFloat(koord[1])], 
			{
				hintContent: 'TYTKOLESA',
				balloonContent: adres
			}, {
				iconLayout: 'default#image',
				iconImageHref: '/local/templates/main/img/marker-pin-01.svg',
				iconImageSize: [56, 56],
				iconImageOffset: [-28, -56]
			}
		);

		// Добавляем точку на карту
		mapContacts.geoObjects.add(PlacemarkContacts);
		
	}
});


})


