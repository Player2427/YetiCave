  <main>
    <?=$nav?>
    <section class="lot-item container">
      <h2><?=$lot['lot-name']?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?=$lot['path']?>" width="730" height="548" alt="<?=$lot['hint']?>">
          </div>
          <p class="lot-item__category">Категория: <span><?=$lot['category']?></span></p>
          <p class="lot-item__description"><?=$lot['message']?></p>
        </div>
        <div class="lot-item__right">
          <?php if (isset($_SESSION['username'])): ?>
          <div class="lot-item__state">
            <div class="lot-item__timer timer">
              <?=time_diff($lot['lot-date']);?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=format_price($lot['lot-rate']);?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?=$lot['lot-rate']+$lot['lot-step']?></span>
              </div>
            </div>
            <form class="lot-item__form" action="inc/form-bet.php" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?php if (isset($_SESSION['errors']['cost'])) echo 'form__item--invalid';?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?=$_SESSION['min-bet-price']=$lot['lot-rate']+$lot['lot-step']?>">
                <span class="form__error"><?=$_SESSION['errors']['cost']?></span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <?php endif; ?>
          <div class="history">
            <h3>История ставок (<span><?=$lot['bets']?></span>)</h3>
            <table class="history__list">
              <?php foreach ($bets as $key => $value) { ?>
              <tr class="history__item">
                <td class="history__name"><?=$value['name']?></td>
                <td class="history__price"><?=format_price($value['price'], 'р')?></td>
                <td class="history__time"><?=format_datetime($value['time'])?></td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>