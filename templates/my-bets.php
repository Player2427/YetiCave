  <main>
    <?=$nav?>
    <section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
        <?php foreach ($bets as $bet) { 
        $win = false;
        $end = false;
        if (timer_finishing($bet['LotDate'], 0)) $end = true;
        if ($end and last_bet($bet['BetID'])) $win = true;?>
        <tr class="rates__item <?php if ($win) echo "rates__item--win"; else if ($end) echo "rates__item--end";?>">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$bet['LotPath']?>" width="54" height="40" alt="">
            </div>
            <div>
              <h3 class="rates__title"><a href="lot/?lotid=<?=$bet['LotID'];?>"><?=$bet['LotName']?></a></h3>
              <?php if ($win) echo "<p>{$bet['UserMessage']}</p>"; ?>
            </div>
          </td>
          <td class="rates__category">
            <?=$bet['CategoryName']?>
          </td>
          <td class="rates__timer">
            <?php if ($win) {?>
              <div class="timer timer--win">Ставка выиграла</div>
            <?php } else if ($end) { ?>
              <div class="timer timer--end">Торги окончены</div>
            <?php } else { ?>
            <div class="timer <?php if (timer_finishing($bet['LotDate'], 3600)) echo "timer--finishing";?>"><?=time_diff($bet['LotDate']);?></div>
            <?php } ?>
          </td>
          <td class="rates__price">
            <?=format_price($bet['BetPrice'], 'р')?>
          </td>
          <td class="rates__time">
            <?=format_datetime($bet['BetTime'])?>
          </td>
        </tr>
        <?php } ?>
        <?php if (empty($bets)) echo "У вас пока что нет ставок";?>
      </table>
    </section>
  </main>