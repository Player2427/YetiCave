  <main>
    <?=$nav?>
    <div class="container">
      <section class="lots">
        <h2><?=$title;?></h2>
        <ul class="lots__list">
        <?php 
          if (isset($_COOKIE['history'])) {
            $id = json_decode($_COOKIE['history'], true);
            foreach ($id as $key):
              $lot = $lots[$key];
              echo include_template('blocks/lot.php', ['lot' => $lot, 'key' => $key]);
            endforeach;
          } else {
            echo 'История просмотров пуста';
          }
        ?>
        </ul>
      </section>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
      </ul>
    </div>
  </main>