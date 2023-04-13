
  <main>
    <?=$nav?>
    <form class="form container <?php if (!empty($_SESSION['errors_reg'])) echo "form--invalid";?>" action="inc/form-reg.php" method="post" autocomplete="off"> <!-- form
    --invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?php if (isset($_SESSION['errors_reg']['email'])) echo 'form__item--invalid'?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" value="<?=$_SESSION['reg']['email']?>" placeholder="Введите e-mail">
        <span class="form__error"><?=$_SESSION['errors_reg']['email']?></span>
      </div>
      <div class="form__item <?php if (isset($_SESSION['errors_reg']['password'])) echo 'form__item--invalid'?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?=$_SESSION['reg']['password']?>" placeholder="Введите пароль">
        <span class="form__error"><?=$_SESSION['errors_reg']['password']?></span>
      </div>
      <div class="form__item <?php if (isset($_SESSION['errors_reg']['name'])) echo 'form__item--invalid'?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" value="<?=$_SESSION['reg']['name']?>" placeholder="Введите имя">
        <span class="form__error"><?=$_SESSION['errors_reg']['name']?></span>
      </div>
      <div class="form__item <?php if (isset($_SESSION['errors_reg']['message'])) echo 'form__item--invalid'?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=$_SESSION['reg']['message']?></textarea>
        <span class="form__error"><?=$_SESSION['errors_reg']['message']?></span>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="index.php?page=login">Уже есть аккаунт</a>
    </form>
  </main>
