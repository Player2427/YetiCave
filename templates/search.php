  <main>
    <?=$nav?>
    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$_SESSION['search'];?></span>»</h2>
        <ul class="lots__list">
        <?php foreach ($lots as $key => $lot): ?>
          <?=include_template('blocks/lot.php', ['lot' => $lot, 'key' => $key])?>
        <?php endforeach; ?>
        <?php if (empty($lots)) echo "Ничего не найдено по вашему запросу";?>
        </ul>
      </section>
      <?php if (!empty($lots)):?>
        <ul class="pagination-list">
          <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
          <li class="pagination-item pagination-item-active"><a>1</a></li>
          <li class="pagination-item"><a href="#">2</a></li>
          <li class="pagination-item"><a href="#">3</a></li>
          <li class="pagination-item"><a href="#">4</a></li>
          <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
        <?php endif;?>
    </div>
  </main>