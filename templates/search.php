  <main>
    <?=$nav?>
    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$_SESSION['search'];?></span>»</h2>
        <ul class="lots__list">
        <?php foreach (pagination_lots($lots) as $key => $lot): ?>
          <?=include_template('blocks/lot.php', ['lot' => $lot, 'key' => $key])?>
        <?php endforeach; ?>
        <?php if (empty($lots)) echo "Ничего не найдено по вашему запросу";?>
        </ul>
      </section>
      <?php if (count($lots)>9): ?>
        <ul class="pagination-list">
          <li class="pagination-item pagination-item-prev">
            <?php echo (isset($_GET['pagination']) and $_GET['pagination'] != 1 and $_GET['pagination'] <= count_pages($lots, 9))
              ? '<a href="'.pagination_url($_GET['pagination']-1).'">' 
              : "<a>" ?>
            Назад</a></li>
          
          <?php for ($i=1; $i<=count_pages($lots, 9); $i++) { ?>
            <?php if ($i == $_GET['pagination'] or $i == 1 and (!isset($_GET['pagination']) or $_GET['pagination'] > count_pages($lots, 9))) echo '<li class="pagination-item pagination-item-active"><a>'.$i.'</a></li>'; 
            else echo '<li class="pagination-item"><a href="'.pagination_url($i).'">'.$i.'</a></li>';?>
          <?php } ?>
          
          <li class="pagination-item pagination-item-next">
            <?php if ($_GET['pagination'] != count_pages($lots, 9)) {
              echo '<a href="'; if (isset($_GET['pagination']) and $_GET['pagination'] <= count_pages($lots, 9)) echo pagination_url($_GET['pagination']+1); else echo pagination_url(2); echo '">';}
              else echo '<a>' ?>
            Вперед</a></li>
        </ul>
        <?php endif; ?>
    </div>
  </main>