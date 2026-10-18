<?php
$page = 'options';
$btn = get_field('header_btn', $page) ?? [];
$phones = get_field('contacts_phones', $page) ?? '';
$time = get_field('contacts_time', $page) ?? '';
$address = get_field('contacts_address', $page) ?? '';
$messengers = get_field('contacts_messengers', $page) ?? '';
?>
<header class="header" data-auto-calc="header, height">
	<div class="header__container container">
		<div class="header__logo logo">
			<?php mx_logo(); ?>
		</div>
		<nav class="header__menu header-menu">
			<button class="header-menu__close-btn menu-close-btn visible-tablet" type="button" aria-label="Закрыть меню">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M12 2.25C6.62391 2.25 2.25 6.62391 2.25 12C2.25 17.3761 6.62391 21.75 12 21.75C17.3761 21.75 21.75 17.3761 21.75 12C21.75 6.62391 17.3761 2.25 12 2.25ZM16.0608 15L15 16.0608L12 13.0608L9 16.0608L7.93922 15L10.9392 12L7.93922 9L9 7.93922L12 10.9392L15 7.93922L16.0608 9L13.0608 12L16.0608 15Z"
						fill="url(#paint0_linear_117_300)" />
					<defs>
						<linearGradient id="paint0_linear_117_300" x1="21.6295" y1="21.75" x2="2.37045" y2="2.25"
							gradientUnits="userSpaceOnUse">
							<stop stop-color="#F28C28" />
							<stop offset="1" stop-color="#FFB347" />
						</linearGradient>
					</defs>
				</svg>
			</button>
			<div class="header-menu__top header-menu-top hidden-tablet">
				<a class="header-menu-top__phone link icon icon--phone"
					href="tel:+<?= esc_attr(correct_phone($phones[0]['contacts_phones_phone'])) ?>">
					<?= esc_html($phones[0]['contacts_phones_phone']) ?>
				</a>
				<div class="header-menu-top__time descr icon icon--time">
					<?= wp_kses_post($time) ?>
				</div>
				<address class="header-menu-top__address descr icon icon--address">
					<?= wp_kses_post($address) ?>
				</address>
			</div>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'container' => false,
					'menu_class' => 'header-menu__list',
					'depth' => 1
				)
			); ?>
			<a class="btn header-menu__btn" href="<?php echo esc_attr($btn['url']) ?>">
				<?php echo esc_html($btn['title']) ?>
			</a>
			<?php get_template_part('partials/components/contacts-box', null, ['class' => 'visible-tablet']); ?>
		</nav>
		<a class="header__phone-btn phone-btn visible-tablet" aria-label="Телефон"
			href="tel:+<?= esc_attr(correct_phone($phones[0]['contacts_phones_phone'])) ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M22.4503 17.3503C22.2056 17.0896 21.3417 16.319 19.7536 15.2995C18.1537 14.271 16.9739 13.6298 16.6354 13.4803C16.6056 13.467 16.5727 13.4622 16.5404 13.4662C16.508 13.4703 16.4773 13.4831 16.4517 13.5032C15.9065 13.9284 14.9887 14.7093 14.9395 14.7515C14.6217 15.0238 14.6217 15.0238 14.3615 14.939C13.904 14.789 12.4828 14.0343 11.2443 12.7931C10.0059 11.5518 9.21231 10.0954 9.06231 9.63838C8.97653 9.37775 8.97653 9.37775 9.24981 9.05994C9.292 9.01072 10.0734 8.09291 10.4986 7.54822C10.5187 7.52257 10.5315 7.49191 10.5356 7.45954C10.5396 7.42716 10.5348 7.3943 10.5215 7.36447C10.372 7.02557 9.73075 5.84619 8.70231 4.24635C7.68137 2.65869 6.91168 1.79479 6.65106 1.5501C6.62714 1.52753 6.59758 1.51183 6.56549 1.50465C6.5334 1.49747 6.49997 1.49909 6.46872 1.50932C5.55769 1.82239 4.67869 2.22186 3.84371 2.70229C3.03766 3.17086 2.27455 3.70967 1.56325 4.31244C1.53842 4.33355 1.5198 4.36102 1.5094 4.3919C1.49899 4.42279 1.49719 4.45592 1.50418 4.48775C1.60215 4.94432 2.07043 6.85025 3.52356 9.49025C5.00621 12.1846 6.03372 13.5651 8.21106 15.7349C10.3884 17.9048 11.8125 18.9942 14.5097 20.4768C17.1497 21.9299 19.0565 22.3987 19.5122 22.4957C19.5441 22.5027 19.5772 22.5008 19.6082 22.4904C19.6391 22.48 19.6667 22.4614 19.6879 22.4367C20.2906 21.7254 20.8293 20.9623 21.2976 20.1562C21.778 19.3212 22.1774 18.4422 22.4906 17.5312C22.5006 17.5002 22.5022 17.467 22.4951 17.4352C22.488 17.4034 22.4725 17.3741 22.4503 17.3503Z"
					fill="#F28C28" />
			</svg>
		</a>
		<button class="header__burger-btn burger-btn-icon header-mobile-btn visible-tablet" type="button"
			aria-label="Открыть/закрыть меню">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M3 18H21V15.9998H3V18ZM3 12.9998H21V11.0002H3V12.9998ZM3 6V8.00016H21V6H3Z"
					fill="url(#paint0_linear_104_110)" />
				<defs>
					<linearGradient id="paint0_linear_104_110" x1="20.8888" y1="18" x2="10.0008" y2="1.46368"
						gradientUnits="userSpaceOnUse">
						<stop stop-color="#F28C28" />
						<stop offset="1" stop-color="#FFB347" />
					</linearGradient>
				</defs>
			</svg>
		</button>
	</div>
</header>