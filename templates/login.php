  <main>
    <?=$nav?>
    <form class="form container" action="inc/form-auth.php" method="post"> <!-- form--invalid -->
      <h2>Вход</h2>
      <div class="form__item <?php echo isset($_SESSION['errors']['email'])?'form__item--invalid':'';?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" value="<?=$_SESSION['new-auch']['email']?>" placeholder="Введите e-mail">
        <span class="form__error"><?=$_SESSION['errors']['email']?></span>
      </div>
      <div class="form__item form__item--last <?php echo isset($_SESSION['errors']['password'])?'form__item--invalid':'';?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?=$_SESSION['new-auch']['password']?>" placeholder="Введите пароль">
        <span class="form__error"><?=$_SESSION['errors']['password']?></span>
      </div>
      <button type="submit" class="button">Войти</button>
    </form>
  </main>