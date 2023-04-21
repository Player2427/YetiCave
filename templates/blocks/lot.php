<li class="lots__item lot">
        <div class="lot__image">
          <img src="<?=$lot['path'];?>" width="350" height="260" alt="<?=$lot['hint'];?>">
        </div>
        <div class="lot__info">
          <span class="lot__category"><?=$lot['category'];?></span>
          <h3 class="lot__title"><a class="text-link" href="lot/?lotid=<?=$lot['id'];?>"><?=$lot['lot-name'];?></a></h3>
          <div class="lot__state">
            <div class="lot__rate">
              <span class="lot__amount">
                <?=($lot['bets'] == 0)?('Стартовая цена'):$lot['bets'].' '.get_noun_plural_form($lot['bets'], 'ставка', 'ставки', 'ставок')?>
                </span>
              <span class="lot__cost"><?=format_price($lot['lot-rate']);?></span>
            </div>
            <div class="lot__timer timer <?php if (timer_finishing($lot['lot-date'])) echo "timer--finishing";?>">
            <?=time_diff($lot['lot-date']);?>
            </div>
          </div>
        </div>
      </li>