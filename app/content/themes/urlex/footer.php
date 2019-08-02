	</div>
	<footer class="main-footer">
		<div class="container">
			<div class="row">
				<div class="col-xl-4 col-lg-12 mb-5 mb-lg-0">
					<div class="footer-logo d-flex align-items-center">
						<img class="mr-3" src="<?php echo get_template_directory_uri(); ?>/build/img/logo_white.png" alt="ЮрлексПроф">
						<span class="logo-text mb-0">ЮрлексПроф</span>
					</div>
					<p class="mt-5">
						© 2013—2018 ЮрлексПроф.<br>
						Сайт не является публичной офертой и носит информационный характер.
					</p>
				</div>
				<div class="col-xl-3 col-md-4 col-6 mb-5 mb-md-0">
					<?php $args = array(
						'theme_location'  => 'footer_main',
						'container'       => 'nav',
						'container_class' => 'footer-nav',
						'menu_class'      => 'footer-menu',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 1
					); ?>
					<?php wp_nav_menu( $args ); ?>
				</div>
				<div class="col-xl-3 col-md-4 col-6 mb-5 mb-md-0">
					<?php $args = array(
						'theme_location'  => 'footer_second',
						'container'       => 'nav',
						'container_class' => 'footer-nav',
						'menu_class'      => 'footer-menu',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 1
					); ?>
					<?php wp_nav_menu( $args ); ?>
				</div>
				<div class="col-xl-2 col-md-4 col-sm-12 d-flex flex-column align-items-xl-end align-items-start">
					<a class="pb-3" href="mailto:mail@urlexprof.ru">mail@urlexprof.ru</a>
					<a href="tel:+74956430005">8 (495) 643 00 05</a>
					<a href="tel:+74957498446">8 (495) 749 84 46</a>
					<a href="tel:+79067974646">+7 (906) 797 46 46</a>
					<button class="back-call-btn my-3" data-toggle="modal" data-target="#back-call">Обратный звонок</button>
					<ul class="footer-social">
						<li><a href="#" target="_blank"><i class="fa fa-vk fa-2x"></i></a></li>
						<li><a href="#" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
						<li><a href="#" target="_blank"><i class="fa fa-odnoklassniki fa-2x"></i></a></li>
						<li><a href="#" target="_blank"><i class="fa fa-youtube fa-2x"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
					<div class="row">
						<div class="col d-flex justify-content-between">
							<p><a href="#">Политика конфиденциальности</a></p>
							<p>Связаться в скайпе: <a href="skype:nick_on01?chat">urlexprof.ru</a></p>
							<p>Продвижение сайта: Максим Истляев</p>
						</div>
					</div>
			</div>
		</div>
	</footer>

	<!-- Back Call Modal -->
	<div class="modal fade back-call-modal" id="back-call" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body">
					<h2 class="title">Заказать обратный звонок</h2>
					<form class="back-call-form-modal materia-form materia-form--accent" id="form-common-callback">
						<div class="row">
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="back-call-modal-name" type="text" name="input_name" class="float-field" placeholder="Андрей Иванов" required/>
									<label for="back-call-modal-name" class="float-label">Имя</label>
									<div class="field-bar"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="back-call-modal-phone" type="text" name="input_phone" placeholder="8 800 500 ***" class="float-field" required/>
									<label for="back-call-modal-phone" class="float-label">Телефон</label>
									<div class="field-bar"></div>
								</div>
							</div>
						</div>
						<div class="field-wrapper">
							<input id="back-call-modal-email" type="email" name="input_email" placeholder="example@gmail.com" class="float-field" required/>
							<label for="back-call-modal-email" class="float-label">E-mail</label>
							<div class="field-bar"></div>
						</div>
						<div class="d-flex flex-column flex-md-row">
							<div class="w-auto order-1 order-md-0 mt-3 mt-md-0">
								<button class="btn" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#msg-send"><span>Отправить</span></button>
							</div>
							<div class="field-wrapper mb-0 ml-0 ml-md-3 flex-grow-1">
								<div class="checkbox-wrapper">
									<input id="back-call-modal-check" type="checkbox" checked="checked"/>
									<label for="back-call-modal-check">Нажимая на кнопку «Отправить», я даю согласие на обработку персональных данных и соглашаюсь с политикой конфиденциальности</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Calculator Modal -->
	<div class="modal fade calculator-modal" id="calculator-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<h2 class="title">Укажите ваш e-mail<br><span>и мы отправим файл с расчётом</span></h2>
				<p>Стоимость услуг не зависит от сроков и различных сценариев процедуры банкротства</p>
				<form class="back-call-form-modal materia-form materia-form--accent" id="form-calc-callback">
					<div class="field-wrapper">
						<input id="calculator-modal-email" type="email" name="input_email" placeholder="example@gmail.com" class="float-field" required/>
						<label for="calculator-modal-email" class="float-label">E-mail</label>
						<div class="field-bar"></div>
					</div>
					<div class="d-flex flex-column flex-md-row">
						<div class="w-auto order-1 order-md-0 mt-3 mt-md-0">
							<button class="btn" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#msg-send"><span>Отправить</span></button>
						</div>
						<div class="field-wrapper mb-0 ml-0 ml-md-3 flex-grow-1">
							<div class="checkbox-wrapper">
								<input id="calculator-modal-check" type="checkbox" checked="checked"/>
								<label for="calculator-modal-check">Нажимая на кнопку «Отправить», я даю согласие на обработку персональных данных и соглашаюсь с политикой конфиденциальности</label>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	<!-- Msg Send Modal -->
	<div class="modal fade msg-send-modal" id="msg-send" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body">
					<h2 class="title">Сообщение отправлено</h2>
					<p>Ваше сообщение успешно отправлено. Наши менеджеры свяжутся с вами в ближайшее время и ответят на все ваши вопросы.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
var yaParams = {/*Здесь параметры визита*/};
</script>

<script type="text/javascript">
(function (d, w, c) {
	(w[c] = w[c] || []).push(function() {
		try {
			w.yaCounter14932780 = new Ya.Metrika({id:14932780, enableAll: true, trackHash:true, webvisor:true,params:window.yaParams||{ }});
		} catch(e) {}
	});

	var n = d.getElementsByTagName("script")[0],
		s = d.createElement("script"),
		f = function () { n.parentNode.insertBefore(s, n); };
	s.type = "text/javascript";
	s.async = true;
	s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

	if (w.opera == "[object Opera]") {
		d.addEventListener("DOMContentLoaded", f);
	} else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/14932780" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script src="<?php echo get_template_directory_uri(); ?>/build/js/main.min.js"></script>
<?php wp_footer(); ?>

<script>
	$(function () {
		var el = document.getElementsByClassName('toc_toggle')[0], child = el.firstChild, nextChild;
		while (child) {
			nextChild = child.nextSibling;
			if (child.nodeType == 3) {
				el.removeChild(child);
			}
			child = nextChild;
		}
	});
</script>

</body>
</html>
