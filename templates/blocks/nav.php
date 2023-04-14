<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($category as $value): ?>
        <li class="nav__item">
            <a href="index.php?page=all-lots&catid=<?=$value['id']?>"><?=$value['name']?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>