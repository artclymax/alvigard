<?php
$page = 'options';

$title = get_field('thank_you_title', $page) ?? get_the_title();
$descr = get_field('thank_you_descr', $page) ?? '';
$btn = get_field('thank_you_btn', $page) ?? '';
$image = get_field('thank_you_image', $page) ?? '';
?>
<section class="hero-404 hero-thank-you jarallax" id="hero-thank-you">
	<div class="container hero-404__container">
		<div class="hero-404__wrapper">
			<h1 class="hero-404__title title-1">
				<?php echo esc_html($title) ?>
			</h1>
			<div class="hero-404__descr descr title-3">
				<?php echo wp_kses_post($descr) ?>
			</div>
			<div class="hero-thank-you__form">
				<p>
					Проверьте правильность данных
				</p>
				<input class="hero-thank-you__input form-input form-field__input" type="text" placeholder="Имя"
					value="<?php echo $_GET['user_name'] ?? ''; ?>" readonly="" />
				<input class="hero-thank-you__input form-input form-field__input" type="text" placeholder="Телефон"
					value="+<?php echo $_GET['user_phone'] ?? ''; ?>" readonly="" />
				<a class="btn hero-thank-you__btn" href="<?php echo esc_url($btn['url']) ?>">
					<?php echo esc_html($btn['title']) ?>
				</a>
			</div>
		</div>
	</div>
	<div class="hero-404__image image-box jarallax-img">
		<?php echo wp_get_attachment_image(
			$image['ID'],
			'large',
			false,
			array(
				'class' => 'img',
				'alt' => $image['alt'] ?: ''
			)
		); ?>
	</div>
</section>