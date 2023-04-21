<main class="container">
  <section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php foreach ($category as $value): ?>
        <li class="promo__item promo__item--<?=$value['style']?>">
          <a class="promo__link" href="all-lots/?catid=<?=$value['id']?>"><?=$value['name']?></a>
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
        <?=include_template('blocks/lot.php', ['lot' => $lot, 'key' => $key])?>
      <?php endforeach; ?>
      <?php if (empty($lots)) echo "Сейчас нет открытых лотов"; ?>
    </ul>
  </section>
</main>
