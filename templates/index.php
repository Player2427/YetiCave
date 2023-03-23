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
      <?php foreach ($lots as $key => $lot): ?>
        <?=include_template('blocks/lot.php', ['lot' => $lot])?>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
