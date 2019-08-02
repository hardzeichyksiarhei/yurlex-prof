
<?php get_header(); ?>

	<section class="home">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 pl-0 main-carousel-container">
					<div class="main-carousel owl-carousel owl-theme">
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo1.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo2.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo3.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo4.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo5.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
						<div class="item">
							<img src="<?php echo get_template_directory_uri(); ?>/build/img/bankrotstvo6.jpg" alt="Услуги банкротства от компании ЮрлексПроф">
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="sticky-post mt-5">
						<h1 class="sticky-post__title title">Банкротство физических и юридических лиц, ИП</h1>
						<p class="sticky-post__description">
							Юридическая компания «ЮрлексПроф» - это команда опытных юристов, Арбитражных управляющих, аудиторов, работает с 2000 года, выигрываем более 4500 судебных дел в судах общей юрисдикции и арбитражных судах города Москвы, списали более 1 млрд долгов, с Нами у Вас всегда компетентная поддержка
						</p>
						<a class="btn mt-3" href="/about_company/"><span>Узнать больше</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="vigodi">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="title">Ваши выгоды</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_1.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">Избавим вас от коллекторов с первого дня</p>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_2.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">Легально спишем все ваши задолженности, сохранив имущество</p>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_3.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">С вас снимут все аресты, восстановят право выезда заграницу</p>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_4.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">Через 21 день вы законно не будете платить по долгам</p>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_5.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">Все судебные дела в вашем отношении будут прекращены</p>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6">
					<div class="vigoda-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/vigodi/vigoda_img_6.png" alt="" class="vigoda-block__img">
						<p class="vigoda-block__description">Вы сможете начать жизнь с чистого листа</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="question">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 d-flex flex-column">
					<h2 class="title title--white">Остались вопросы?</h2>
					<p class="question__description">Закажите обратный звонок и мы бесплатно вас проконсультируем.</p>
				</div>
				<div class="col-lg-8">
				<form class="question-form materia-form" id="form-front-callback">
						<div class="row">
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="question-name" type="text" name="input_name" class="float-field" placeholder="Андрей Иванов" required/>
									<label for="question-name" class="float-label">Имя</label>
									<div class="field-bar"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="question-phone" type="text" name="input_phone" placeholder="8 800 500 ***" class="float-field" required/>
									<label for="question-phone" class="float-label">Телефон</label>
									<div class="field-bar"></div>
								</div>
							</div>
						</div>
						<div class="field-wrapper">
							<input id="question-email" type="email" name="input_email" placeholder="example@gmail.com" class="float-field" required/>
							<label for="question-email" class="float-label">E-mail</label>
							<div class="field-bar"></div>
						</div>
						<div class="d-flex flex-column flex-md-row">
							<div class="button-wrapper w-auto order-1 order-md-0 mt-3 mt-md-0">
								<button id="question-send" type="submit">Отправить</button>
							</div>
							<div class="field-wrapper mb-0 ml-0 ml-md-3 flex-grow-1">
								<div class="checkbox-wrapper">
									<input id="question-check" type="checkbox" checked="checked"/>
									<label for="question-check">Нажимая на кнопку «Отправить», я даю согласие на обработку персональных данных и соглашаюсь с политикой конфиденциальности</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="conditions">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="title">Условия банкротства</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 mb-4">
					<div class="condition-block content-block content-block--shadow content-block--radius">
						<h3 class="condition-block__title">Вы обязаны объявить себя банкротом</h3>
						<div class="condition-block__body">
							<div class="row">
								<div class="col-md-6">
									<div class="condition-sub-block">
										<img src="<?php echo get_template_directory_uri(); ?>/build/img/conditions/condition_img_1.png" alt="" class="condition-sub-block__img">
										<h4 class="condition-sub-block__title">Задолженность</h4>
										<p class="condition-sub-block__description">Избавим вас от коллекторов с первого дня</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="condition-sub-block">
										<img src="<?php echo get_template_directory_uri(); ?>/build/img/conditions/condition_img_2.png" alt="" class="condition-sub-blockk__img">
										<h4 class="condition-sub-block__title">Просрочка</h4>
										<p class="condition-sub-block__description">Избавим вас от коллекторов с первого дня</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mb-4 d-flex justify-content-end">
					<div class="condition-block content-block content-block--shadow content-block--radius">
						<h3 class="condition-block__title">Вы можете объявить себя банкротом</h3>
						<div class="condition-block__body">
							<div class="row">
								<div class="col-md-6">
									<div class="condition-sub-block">
										<img src="<?php echo get_template_directory_uri(); ?>/build/img/conditions/condition_img_2.png" alt="" class="condition-sub-block__img">
										<h4 class="condition-sub-block__title">Задолженность</h4>
										<p class="condition-sub-block__description">Ваш общий долг по займам и кредитам не превышает 500 000 рублей</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="condition-sub-block">
										<img src="<?php echo get_template_directory_uri(); ?>/build/img/conditions/condition_img_1.png" alt="" class="condition-sub-blockk__img">
										<h4 class="condition-sub-block__title">Просрочка</h4>
										<p class="condition-sub-block__description">Задолженность по долгу превышает 3 месяца, при этом нет финансовой возможности её выплачивать</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="examples">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="title">Примеры нашей работы</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-3">
					<div class="item-legend">
						<div class="examples-legend examples-table content-block content-block--shadow content-block--radius">
							<p>Номер дела</p>
							<p>ФИО судьи</p>
							<p>Решение суда</p>
							<p>Списано долгов</p>
							<p>Срок банкротства</p>
							<p>Cайт арбитражного суда</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-9">
					<div class="examples-carousel owl-carousel owl-theme">
						<div class="item">
							<div class="examples-table content-block content-block--shadow content-block--radius">
								<p><a href="/wp-content/uploads/dela/delo01.pdf">А40-111355/13</a></p>
								<p>А.А. Сафронова</p>
								<p>Завершить конкурсное производство в отношении ЗАО «РТС Лоджик». Требования кредиторов, не удовлетворенные по причине недостаточности имущества должника, считаются погашенными.</p>
								<p>2 426 260 р</p>
								<p>3 года 9 месяцев</p>
								<p><a href="https://kad.arbitr.ru/Card/285bf7a5-dc4d-4a98-b723-57807020fa64">Арбитражный суд</a></p>
							</div>
						</div>
						<div class="item">
							<div class="examples-table content-block content-block--shadow content-block--radius">
								<p><a href="/wp-content/uploads/dela/delo02.pdf">А40-89155/17</a></p>
								<p>П.А. Марков</p>
								<p>Освободить Минаеву Е.В. от дальнейшего исполнения требований кредиторов, в том числе требований кредиторов, не заявленных при введении реструктуризации долгов гражданина или реализации имущества гражданина.</p>
								<p>718 321 р</p>
								<p>11 месяцев</p>
								<p><a href="https://kad.arbitr.ru/Card/7cc3bab2-6505-4dd6-a819-a2d8e2169d3a">Арбитражный суд</a></p>
							</div>
						</div>
						<div class="item">
							<div class="examples-table content-block content-block--shadow content-block--radius">
								<p><a href="/wp-content/uploads/dela/delo03.pdf">А41-78459/17</a></p>
								<p>П.М. Морхат</p>
								<p>Освободить Кормилову Е.А. от дальнейшего исполнения требований кредиторов, в том числе требований кредиторов, не заявленных при введении реализации имущества гражданина.</p>
								<p>0 р</p>
								<p>9 месяцев</p>
								<p><a href="https://kad.arbitr.ru/Card/9293dedc-8513-4bea-a5df-bd59c230941a">Арбитражный суд</a></p>
							</div>
						</div>
						<div class="item">
							<div class="examples-table content-block content-block--shadow content-block--radius">
								<p><a href="/wp-content/uploads/dela/delo04.pdf">А40-148954/16</a></p>
								<p>А.А. Архипов</p>
								<p>Завершить конкурсное производство в отношении ООО «СтройИнвестПроект». Требования кредиторов, не удовлетворенные по причине недостаточности имущества должника, считаются погашенными. Погашенными считаются также требования кредиторов, не признанные конкурсным управляющим, если кредитор не обращался в арбитражный суд либо такие требования признаны необоснованными.</p>
								<p>10 172 700 р</p>
								<p>1 год 2 месяца</p>
								<p><a href="https://kad.arbitr.ru/Card/4352ed46-1ecb-4f8d-8c5f-cb93ea08d201">Арбитражный суд</a></p>
							</div>
						</div>
						<div class="item">
							<div class="examples-table content-block content-block--shadow content-block--radius">
								<p><a href="/wp-content/uploads/dela/delo05.pdf">А66-18944/2011</a></p>
								<p>И.В. Шабельная</p>
								<p>Завершить конкурсное производство в отношении ООО «Тверские мясопродукты».</p>
								<p>71 209 687 р</p>
								<p>6 лет 7 месяцев</p>
								<p><a href="https://kad.arbitr.ru/Card/2c6faad8-868c-4362-bd5d-618c406f77e1">Арбитражный суд</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="back-call">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 d-flex flex-column">
					<h2 class="title title--white">Заказать обратный звонок</h2>
					<p class="back-call__description">Оставьте заявку, чтобы мы могли с вами связаться и договориться о времени проведения бесплатной консультации.</p>
				</div>
				<div class="col-lg-8">
					<form class="back-call-form materia-form" id="form-front-callback2">
						<div class="row">
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="back-call-name" type="text" name="input_name" class="float-field" placeholder="Андрей Иванов" required/>
									<label for="back-call-name" class="float-label">Имя</label>
									<div class="field-bar"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="field-wrapper">
									<input id="back-call-phone" type="text" name="input_phone" placeholder="8 800 500 ***" class="float-field" required/>
									<label for="back-call-phone" class="float-label">Телефон</label>
									<div class="field-bar"></div>
								</div>
							</div>
						</div>
						<div class="field-wrapper">
							<input id="back-call-email" type="email" name="input_email" placeholder="example@gmail.com" class="float-field" required/>
							<label for="back-call-name" class="float-label">E-mail</label>
							<div class="field-bar"></div>
						</div>
						<div class="d-flex flex-column flex-md-row">
							<div class="button-wrapper w-auto order-1 order-md-0 mt-3 mt-md-0">
								<button id="back-call-send" type="submit">Отправить</button>
							</div>
							<div class="field-wrapper mb-0 ml-0 ml-md-3 flex-grow-1">
								<div class="checkbox-wrapper">
									<input id="back-call-check" type="checkbox" checked="checked"/>
									<label for="back-call-check">Нажимая на кнопку «Отправить», я даю согласие на обработку персональных данных и соглашаюсь с политикой конфиденциальности</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="why-we">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="title">Почему люди выбирают нас?</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_1.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Первая консультация оказывается бесплатно</p>
					</div>
				</div>
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_2.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Выгодная цена в сочетании с оптимальными сроками банкротства</p>
					</div>
				</div>
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_3.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Финансовые управляющие с экономическим и юридическим образованием</p>
					</div>
				</div>
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_4.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Опыт банкротства более 5 лет</p>
					</div>
				</div>
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_5.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Защита в суде</p>
					</div>
				</div>
				<div class="col-md-4 col-6">
					<div class="why-we-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/why_we/why_we_img_6.png" alt="" class="why-we-block__img">
						<p class="why-we-block__description">Вся процедура банкротства — под ключ</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="warning">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-4 offset-0 offset-md-1">
					<img class="warning__img mb-4 mb-md-0 mr-md-4" src="<?php echo get_template_directory_uri(); ?>/build/img/man.jpg" alt="Man">
				</div>
				<div class="col-md-6">
					<div class="warning-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/triangle.png" alt="" class="warning-block__img">
						<div class="warning-block__content">
							<h5 class="warning-block__title">Участие финансового управляющего в деле о банкротстве гражданина является обязательным (п.1 ст.213.9 закона «О банкротстве»).</h5>
							<p class="warning-block__desc">Это означает, что вы не сможете провести процедуру банкротства самостоятельно, своими силами. По закону требуется наличие финансового управляющего</p>
						</div>
					</div>
					<div class="warning-block">
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/triangle.png" alt="" class="warning-block__img">
						<div class="warning-block__content">
							<h5 class="warning-block__title">Финансовый управляющий обязан быть членом саморегулируемой организации арбитражных управляющих (п.1 ст. 20 закона «О банкротстве»)</h5>
							<p class="warning-block__desc">Это означает, что для осуществления банкротства подойдёт не любой юрист. Он должен быть арбитражным управляющим — специалисты нашей компании как раз ими и являются.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="map">
		<div class="cover">
			<div class="map-content">
				<h3 class="title">Как нас найти?</h3>
				<ul>
					<li>
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/M.png" alt="Metro">
						<p>Чеховская, Тверская, Пушкинская</p>
					</li>
					<li>
						<img src="<?php echo get_template_directory_uri(); ?>/build/img/mark.png" alt="Metro">
						<p>127006, г. Москва, Страстной бульвар, дом 11, строение 1, офис № 1</p>
					</li>
				</ul>
			</div>
		</div>
		<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7e2ef597760998fcb796de1778c0ee0d48dd721eecf9cf9bdc2f79de5f3c6f5d&amp;source=constructor" height="400"></iframe>
	</section>

<?php get_footer(); ?>
