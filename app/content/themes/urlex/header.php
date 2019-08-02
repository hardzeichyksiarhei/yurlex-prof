<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo get_bloginfo(); ?></title>
	<link rel="icon" href="/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/build/img/favicon/apple-touch-icon-180x180.png">
  <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/build/css/main.min.css">
</head>
<body <?php body_class(); ?>>

<div class="wrapper">
	<div class="top-line">
		<div class="container">
			<div class="row">
				<div class="col pt-0 pt-sm-3 d-flex justify-content-between align-items-center flex-wrap">
					<div class="header-logo d-flex align-items-center">
						<?php if (!is_front_page()) { ?>
						<a href="<?php echo get_option("siteurl"); ?>" class="d-flex align-items-center">
						<?php } ?>
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/logo_accent.png" alt="ЮрлексПроф">
							<span class="logo-text mb-0">ЮрлексПроф</span>
						<?php if (!is_front_page()) { ?>
						</a>
						<?php } ?>
					</div>
					<ul class="top-line-menu d-none d-xl-block">
						<li><a href="/about_company/">О компании</a></li>
						<li><a href="/contact/">Контакты</a></li>
					</ul>
					<span class="top-line-hours d-none d-lg-block">9:00 - 18:00, пн-пт</span>
					<div class="top-line-phones d-flex justify-content-center justify-content-md-start my-3 my-md-0 order-3 order-md-0">
						<div class="top-line-phone mr-4">
							<a href="tel:84956430005">8 495 643 00 05</a>
							<small>для звонков</small>
						</div>
						<div class="top-line-phone">
							<a href="tel:+79035498446">+7 903 549 84 46</a>
							<small>круглосуточно</small>
						</div>
					</div>
					<ul class="top-line-social order-2 order-md-0">
						<li>
							<a href="viber://chat?number=79035498446">
								<img src="<?php echo get_template_directory_uri(); ?>/build/img/viber.svg" alt="Viber">
							</a>
						</li>
						<li>
							<a href="https://wa.me/79035498446">
								<img src="<?php echo get_template_directory_uri(); ?>/build/img/whatsapp.svg" alt="WhatsApp">
							</a>
						</li>
						<li>
							<a href="tg://resolve?domain=urlexprof">
								<img src="<?php echo get_template_directory_uri(); ?>/build/img/telegram.svg" alt="Telegram">
							</a>
						</li>
					</ul>
					<button class="top-line-back-call d-none d-xl-block" data-toggle="modal" data-target="#back-call">Обратный звонок</button>
				</div>
			</div>
		</div>
	</div>
	<div class="top-sub-line">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 d-flex justify-content-between align-items-center position-static">
					<div class="top-nav-block">
						<a id="touch-menu" class="mobile-top-menu" href="#"><i class="fa fa-bars pr-2"></i></a>
						<?php $args = array(
							'theme_location'  => 'primary',
							'container'       => 'nav',
							'container_class' => 'top-nav',
							'menu_class'      => 'top-menu',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 2
						); ?>
						<?php wp_nav_menu( $args ); ?>
					</div>
					<div class="search-form-block">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
