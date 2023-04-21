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
      <?php foreach (pagination_lots($lots, 12) as $key => $lot): ?>
        <?=include_template('blocks/lot.php', ['lot' => $lot, 'key' => $key])?>
      <?php endforeach; ?>
      <?php if (empty($lots)) echo "Сейчас нет открытых лотов"; ?>
    </ul>
    <?php if (count($lots)>12): ?>
        <ul class="pagination-list">
          <li class="pagination-item pagination-item-prev">
            <?php echo (isset($_GET['pagination']) and $_GET['pagination'] != 1 and $_GET['pagination'] <= count_pages($lots, 12))
              ? '<a href="'.pagination_url($_GET['pagination']-1).'">' 
              : "<a>" ?>
            Назад</a></li>
          
          <?php for ($i=1; $i<=count_pages($lots, 12); $i++) { ?>
            <?php if ($i == $_GET['pagination'] or $i == 1 and (!isset($_GET['pagination']) or $_GET['pagination'] > count_pages($lots, 12))) echo '<li class="pagination-item pagination-item-active"><a>'.$i.'</a></li>'; 
            else echo '<li class="pagination-item"><a href="'.pagination_url($i).'">'.$i.'</a></li>';?>
          <?php } ?>
          
          <li class="pagination-item pagination-item-next">
            <?php if ($_GET['pagination'] != count_pages($lots, 12)) {
              echo '<a href="'; if (isset($_GET['pagination']) and $_GET['pagination'] <= count_pages($lots, 12)) echo pagination_url($_GET['pagination']+1); else echo pagination_url(2); echo '">';}
              else echo '<a>' ?>
            Вперед</a></li>
        </ul>
        <?php endif; ?>
  </section>
</main>
