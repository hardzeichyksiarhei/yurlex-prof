<?php get_header(); ?>

<section class="calculator">
	<div class="container">
		<div class="row">
			<div class="col">
				<h3 class="title">Стоимость процедуры банкротства</h3>
				<p class="calculator__description">Стоимость, которая будет рассчитана в данном калькуляторе, при условии, что вы корректно заполнили все данные, будет на 100% соответствовать той стоимости, которую рассчитают наши специалисты в офисе. Мы гарантируем, что у нас нет никаких скрытых и дополнительных платежей, чтобы привлечь клиента, а потом накрутить цену. Для Вас цена в договоре будет конечной от обращения в нашу компанию до момента полного списания Ваших долгов</p>
			</div>
		</div>
		<form class="calculator-form materia-form materia-form--accent">	
			<div class="row">
				<div class="col-xl-3 col-lg-12">
					<div class="row justify-content-start  mb-4 mb-xl-0">
						<div class="col-12 col-sm-6 col-xl-12">
							<div class="wrapper-title">Ваш статус</div>
							<div class="radio-wrapper">
								<input id="radio1" name="radio-name-1" type="radio" checked/>
								<label for="radio1">Физическое лицо</label>
							</div>
							<div class="radio-wrapper">
								<input id="radio2" name="radio-name-1" type="radio" />
								<label for="radio2">Юридическое лицо</label>
							</div>
							<div class="radio-wrapper">
								<input id="radio3" name="radio-name-1" type="radio" />
								<label for="radio3">Поручитель</label>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-xl-12">
							<div class="wrapper-title mt-0 mt-xl-3">Возраст</div>
							<div class="radio-wrapper">
								<input id="radio4" name="radio-name-2" type="radio" checked/>
								<label for="radio4">Трудоспособный</label>
							</div>
							<div class="radio-wrapper">
								<input id="radio5" name="radio-name-2" type="radio" />
								<label for="radio5">Пенсионер</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-12">
					<div class="row">
						<div class="col-lg-6">
							<div class="field-wrapper">
								<select name="region" class="select-field" required>
									<option value=""></option>
									<option value="0">Адыгея</option>
									<option value="1">Ярославская область</option>
								</select>
								<label for="region" class="float-label">Регион</label>
								<div class="field-bar"></div>
							</div>
							<div class="field-wrapper meta" data-meta="руб.">
								<input type="text" name="debt" class="float-field" placeholder="1 000 000" required/>
								<label for="debt" class="float-label">Сумма долга</label>
								<div class="field-bar"></div>
							</div>
							<div class="field-wrapper">
								<input type="text" name="creditors" class="float-field" placeholder="0 - 99" required/>
								<label for="creditors" class="float-label">Число кредиторов</label>
								<div class="field-bar"></div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="field-wrapper meta" data-meta="ед.">
								<input type="text" name="property" class="float-field" placeholder="0" required/>
								<label for="property" class="float-label">Залоговое имущество</label>
								<div class="field-bar"></div>
							</div>
							<div class="field-wrapper meta" data-meta="ед.">
								<input type="text" name="cost" class="float-field" placeholder="0" required/>
								<label for="cost" class="float-label">Стоимость имущества</label>
								<div class="field-bar"></div>
							</div>
							<div class="field-wrapper meta" data-meta="ед.">
								<input type="text" name="check" class="float-field" placeholder="0 - 99" required/>
								<label for="check" class="float-label">Из них кредиторов, не являющихся банками и МФО</label>
								<div class="field-bar"></div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-wrapper meta" data-meta="руб.">
								<input type="text" name="income" class="float-field" placeholder="0" required/>
								<label for="income" class="float-label">Доход</label>
								<div class="field-bar"></div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-wrapper">
								<input type="text" name="number_dependents" class="float-field" placeholder="0" required/>
								<label for="number_dependents" class="float-label">Количество иждивенцев</label>
								<div class="field-bar"></div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-wrapper meta" data-meta="%">
								<input type="text" name="alimony " class="float-field" placeholder="0" required/>
								<label for="alimony " class="float-label">Выплаты по алиментам</label>
								<div class="field-bar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-auto"><button class="btn mt-3" type="submit" data-toggle="modal" data-target="#calculator-modal"><span>Отправить</span></button></div>
			</div>
		</form>
		<p class="my-5">Стоимость услуг не зависит от сроков и различных сценариев процедуры банкротства</p>
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
			<form class="question-form materia-form">
					<div class="row">
						<div class="col-md-6">
							<div class="field-wrapper">
								<input id="question-name" type="text" name="name" class="float-field" placeholder="John Smith" required/>
								<label for="question-name" class="float-label">Имя</label>
								<div class="field-bar"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="field-wrapper">
								<input id="question-phone" type="text" name="phone" placeholder="8 800 500 ***" class="float-field" required/>
								<label for="question-phone" class="float-label">Телефон</label>
								<div class="field-bar"></div>
							</div>
						</div>
					</div>
					<div class="field-wrapper">
						<input id="question-email" type="email" name="email" placeholder="example@gmail.com" class="float-field" required/>
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
          <p class="vigoda-block__description">С вас сним ут все аресты, восстановят право выезда заграницу</p>
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