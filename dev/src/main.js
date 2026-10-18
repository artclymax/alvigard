import 'jarallax/dist/jarallax.min.css';
import "@fancyapps/ui/dist/fancybox/fancybox.css";
//import "aos/dist/aos.css";
import './scss/style.scss';
//!
//import { Swiper } from "swiper/bundle";

import { jarallax } from "jarallax";
import { Fancybox } from "@fancyapps/ui/dist/fancybox/";
//import AOS from "AOS";

import { AutoCalc } from "./js/AutoCalc.js";
import { Menu } from './js/Menu.js';
//import { RunningLine } from './js/RunningLine.js';
//import { BackdropList } from './js/BackdropList.js';
import { Modal } from './js/Modal.js';
import { cookies } from "./js/Cookies.js";
import { imask } from "./js/imask.js";
//import { fileBtn } from "./js/FileBtn.js";
//import { CustomFieldSelect } from "./js/CustomFieldSelect.js";
//import { Spoiler } from './js/Spoiler.js';
//import { ScrollToTop } from './js/ScrollToTop.js';
import { MXSwiper } from './js/MXSwiper.js';
//import { CustomSelect } from './js/CustomSelect.js';
//import { Tabs } from './js/Tabs.js';
import { MapScrollLock } from './js/MapScrollLock.js';
//import { cf7CustomValidation } from './js/cf7-validation.js';

//cf7CustomValidation();

// FOR CONTACTS FORM 7
//import "./js/redirect-to-thanks-page.js";


new AutoCalc();
//new CustomFieldSelect({
//	input: '.form-wrapper .cf-select',
//	lastEdit: false
//});
new Menu({
	btn: '.burger-btn-icon',
	menu: '.header-menu',
	activeClass: 'open-header-menu',
	closeBtns: ['.menu-close-btn']
})

//new BackdropList();

new Modal();

jarallax(document.querySelectorAll('.jarallax'), {
	speed: 0.2,
});

cookies();
imask();

Fancybox.bind("[data-fancybox]", {
	placeFocusBack: false
});

//new RunningLine();
//new ScrollToTop();

//new Spoiler();

//new Spoiler('[data-spoiler]', {
//	onlyOneOpen: true,
//	activeClass: 'is-open',
//});

//new Spoiler('.single-team-experience-content', { media: 'max-width: 768px' });

new MXSwiper();
//new Tabs();
//new CustomSelect({
//	selector: 'select',
//	forceSend: true,
//});
/*
window.addEventListener('scroll', function () {
	const header = document.querySelector('.header');

	if (window.scrollY > 50) {
		header.classList.add('scrolled');
	} else {
		header.classList.remove('scrolled');
		const valueUnits = header.offsetHeight;
		document.querySelector(':root').style.setProperty(`--header-height`, valueUnits + 'px');
	}
});
*/

//fileBtn('');

//new Tabs();
//document.querySelectorAll('video.wp-video-shortcode').forEach(video => {
//	if (!video.src) {
//		const link = video.querySelector('a');
//		if (link) video.src = link.href;
//	}
//});

document?.querySelectorAll('.wpcf7-acceptance input[type="checkbox"]')?.forEach(el => {
	el.checked = true;
})

//AOS.init({
//	disable: 'mobile',
//	duration: 600,
//});
/*
const menuItems = document.querySelectorAll('.menu-item-has-children');

if (menuItems.length) {
	document.addEventListener('click', e => {
		if (e.target.closest('.menu-item-has-children')) {
			const item = e.target.closest('.menu-item-has-children');
			item.classList.toggle('active-submenu');
		}
	})
}

const singleProductThumb = new Swiper('.single-product-hero-swiper-thumb', {
	slidesPerView: 3.5,
	spaceBetween: 10,
	//rewind: true,
	freeMode: true,
	watchSlidesProgress: true,
	//watchSlidesVisibility: true,
	breakpoints: {
		'768': {
			slidesPerView: 4,
			spaceBetween: 15,
		}
	}
})

const singleProductGallery = new Swiper('.single-product-hero-swiper', {
	slidesPerView: 1,
	spaceBetween: 24,
	rewind: true,

	thumbs: {
		swiper: singleProductThumb,
	}
})
*/
new MapScrollLock();