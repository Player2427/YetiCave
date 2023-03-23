<main class="container">
  <section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php foreach ($category as $key => $value): ?>
        <li class="promo__item promo__item--<?=$key?>">
          <a class="promo__link" href="index.php?page=all-lots"><?=$value?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <section class="lots">
    <div class="lots__header">
      <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
      <?php foreach ($lots as $key => $value): ?>
      <li class="lots__item lot">
        <div class="lot__image">
          <img src="<?=$value['path'];?>" width="350" height="260" alt="<?=$value['hint'];?>">
        </div>
        <div class="lot__info">
          <span class="lot__category"><?=$value['category'];?></span>
          <h3 class="lot__title"><a class="text-link" href="index.php?page=lot"><?=$value['name'];?></a></h3>
          <div class="lot__state">
            <div class="lot__rate">
              <span class="lot__amount">
                <?=($value['bets'] == 0)?('Стартовая цена'):$value['bets'].' '.get_noun_plural_form($value['bets'], 'ставка', 'ставки', 'ставок')?>
                </span>
              <span class="lot__cost"><?=$value['price'];?><b class="rub">р</b></span>
            </div>
            <div class="lot__timer timer <?=($value['timer--finishing'])?('timer--finishing'):('');?>">
            <?=$value['time'];?>
            </div>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
