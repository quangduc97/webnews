<?php
$tinmoi = $t->TinMoi(5);
while($rowTM = $tinmoi->fetch_assoc()) {
?>

<div class="single_stuff wow fadeInDown">
    <div class="single_stuff_img"> <a href="index.php?p=detail&idTin=<?=$rowTM['idTin']; ?>"><img src="<?=$rowTM['urlHinh'] ?>" onerror="this.src='/news/defaultImg.jpg'" width="100%" height="300px"></a> </div>
    <div class="single_stuff_article">
        <div class="single_sarticle_inner"> <a class="stuff_category" href="#"><?=$rowTM['TenTL'] ?></a>
            <div class="stuff_article_inner"> <span class="stuff_date"><?=date('M', strtotime($rowTM['Ngay'])) ?> <strong><?=date('d', strtotime($rowTM['Ngay'])) ?></strong></span>
                <h2><a href="index.php?p=detail&idTin=<?=$rowTM['idTin']; ?>"><?=$rowTM['TieuDe'] ?></a></h2>
                <p><?=$rowTM['TomTat'] ?></p>
            </div>
        </div>
    </div>
</div>
<?php } ?>