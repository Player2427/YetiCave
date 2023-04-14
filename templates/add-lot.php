<main>
  <?=$nav?>
  <form class="form form--add-lot container <?php echo isset($_SESSION['errors'])?'form--invalid':'';?>" action="inc/form-lot.php" method="post"  enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?php echo isset($_SESSION['errors']['lot-name'])?'form__item--invalid':'';?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование <sup>*</sup></label>
        <input id="lot-name" type="text" name="lot-name" value="<?=$_SESSION['new-lot']['lot-name']?>" placeholder="Введите наименование лота">
        <span class="form__error"><?=$_SESSION['errors']['lot-name']?></span>
      </div>
      <div class="form__item <?php echo isset($_SESSION['errors']['category'])?'form__item--invalid':'';?>">
        <label for="category">Категория <sup>*</sup></label>
        <select id="category" name="category" >
          <option>Выберите категорию</option>
          <? foreach ($category as $value): ?>
          <option <? echo $_SESSION['new-lot']['category'] == $value['name'] ? 'selected':'' ?>><?=$value['name']?></option>
          <? endforeach; ?>
        </select>
        <span class="form__error"><?=$_SESSION['errors']['category']?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?php echo isset($_SESSION['errors']['message'])?'form__item--invalid':'';?>">
      <label for="message">Описание <sup>*</sup></label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$_SESSION['new-lot']['message']?></textarea>
      <span class="form__error"><?=$_SESSION['errors']['message']?></span>
    </div>
    <div class="form__item form__item--file <?php echo isset($_SESSION['errors']['file'])?'form__item--invalid':'';?>">
      <label>Изображение <sup>*</sup></label>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="lot-img" name="lot_img">
        <label for="lot-img">
          Добавить
        </label>
      </div>
      <span class="form__error"><?=$_SESSION['errors']['file']?></span>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?php echo isset($_SESSION['errors']['lot-rate'])?'form__item--invalid':'';?>">
        <label for="lot-rate">Начальная цена <sup>*</sup></label>
        <input id="lot-rate" type="text" name="lot-rate" value="<?=$_SESSION['new-lot']['lot-rate']?>" placeholder="0">
        <span class="form__error"><?=$_SESSION['errors']['lot-rate']?></span>
      </div>
      <div class="form__item form__item--small <?php echo isset($_SESSION['errors']['lot-step'])?'form__item--invalid':'';?>">
        <label for="lot-step">Шаг ставки <sup>*</sup></label>
        <input id="lot-step" type="text" name="lot-step" value="<?=$_SESSION['new-lot']['lot-step']?>" placeholder="0">
        <span class="form__error"><?=$_SESSION['errors']['lot-step']?></span>
      </div>
      <div class="form__item <?php echo isset($_SESSION['errors']['lot-date'])?'form__item--invalid':'';?>">
        <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" value="<?=$_SESSION['new-lot']['lot-date']?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
        <span class="form__error"><?=$_SESSION['errors']['lot-date']?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>