<?php $tinNN = $t->TinNgauNhien(6); ?>
<ul class="featured_nav">
    <?php while($rowNN = $tinNN->fetch_assoc()) { ?>
    <li> <a class="featured_img" href="index.php?p=detail&idTin=<?=$rowNN['idTin']; ?>"><img src="<?=$rowNN['urlHinh'] ?>" onerror="this.src='/news/defaultImg.jpg'" width="100%" height="140px"></a>
        <div class="featured_title"> <a class="" href="index.php?p=detail&idTin=<?=$rowNN['idTin']; ?>"><?=$rowNN['TieuDe'] ?></a> </div>
    </li>
    <?php } ?>
</ul>