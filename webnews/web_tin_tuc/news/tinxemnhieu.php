<?php $tinXN = $t->TinXemNhieu(6) ?>

<ul class="middlebar_nav wow">
    <?php while($rowXN = $tinXN->fetch_assoc()) { ?>
    <li> <a href="index.php?p=detail&idTin=<?=$rowXN['idTin']; ?>" class="mbar_thubnail"><img src="<?=$rowXN['urlHinh'] ?>" onerror="this.src='/news/defaultImg.jpg'" width="95px" height="55px"></a> <a href="index.php?p=detail&idTin=<?=$rowXN['idTin']; ?>" class="mbar_title"><?=$rowXN['TieuDe'] ?></a> </li>
    <?php } ?>
</ul>