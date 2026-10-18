<?php
$page = 'option';

$title = get_field('modal_title', $page);
$image = get_field('modal_image', $page);
$shortcode = get_field('modal_shortcode', $page);
?>
<div class="modal" id="modal-call" data-modal>
	<div class="modal__box modal-call__box" data-modal-box style="background-image: url('<?= esc_attr($image['url']) ?>">
		<button class="modal-call__close-btn modal__close-btn modal-close-btn" data-modal-close aria-label="Закрыть">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M12 2.25C6.62391 2.25 2.25 6.62391 2.25 12C2.25 17.3761 6.62391 21.75 12 21.75C17.3761 21.75 21.75 17.3761 21.75 12C21.75 6.62391 17.3761 2.25 12 2.25ZM16.0608 15L15 16.0608L12 13.0608L9 16.0608L7.93922 15L10.9392 12L7.93922 9L9 7.93922L12 10.9392L15 7.93922L16.0608 9L13.0608 12L16.0608 15Z"
					fill="url(#paint0_linear_117_1470)" />
				<defs>
					<linearGradient id="paint0_linear_117_1470" x1="21.6295" y1="21.75" x2="2.37045" y2="2.25"
						gradientUnits="userSpaceOnUse">
						<stop stop-color="#F28C28" />
						<stop offset="1" stop-color="#FFB347" />
					</linearGradient>
				</defs>
			</svg>
		</button>
		<div class="modal__body">
			<div class="modal__wrapper contacts__form">
				<h3 class="modal__title title-3">
					<?php echo esc_html($title) ?>
				</h3>
				<div class="section-form__form modal__form">
					<?php if ($shortcode): ?>
						<?= do_shortcode($shortcode) ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>