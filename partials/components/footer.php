<?php
$page = 'option';

$copy = get_field('footer_copy', $page) ?? get_bloginfo('name');
$bottom_links = get_field('footer_bottom_links', $page) ?? [];
?>
<footer class="footer">
	<div class="footer__container container">
		<div class="footer__top">
			<div class="footer__logo">
				<?php mx_logo(); ?>
			</div>
			<div class="footer__nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'container' => false,
						'menu_class' => 'footer__nav-list',
						'depth' => 1
					)
				); ?>
			</div>
			<div class="footer__contacts">
				<h3 class="footer__title title-5">
					Контакты
				</h3>
				<?php get_template_part('partials/components/contacts-box', null, ['is_footer' => true]); ?>
			</div>
			<div class="footer__address-box">
				<?php if ($address = get_field('contacts_address', 'option')): ?>
					<div class="footer__address descr icon icon--address">
						<?php echo wp_kses_post($address) ?>
					</div>
				<?php endif; ?>
				<?php if ($time = get_field('contacts_time', 'option')): ?>
					<div class="footer__time descr icon icon--time">
						<?php echo wp_kses_post($time) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="footer__bottom">
			<?php if ($bottom_links): ?>
				<?php foreach ($bottom_links as $link): ?>
					<a class="footer__link" href="<?php echo esc_url($link['footer_bottom_link']['url'] ?? '') ?>">
						<?php echo esc_html($link['footer_bottom_link']['title'] ?? '') ?>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
			<small class="footer__copy">
				&copy; <?php echo esc_html($copy) ?>
				<span><?php echo date('Y') ?></span>
			</small>
		</div>
	</div>
</footer>