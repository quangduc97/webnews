<?php
$idTin = $_GET['idTin'];
settype($idTin,"int");
$tin = $t->ChiTietTin($idTin);
$row_tin = $tin->fetch_assoc();

$t->CapNhatSoLanXemTin($idTin);
?>

<div class="singlepost_area">
    <div class="singlepost_content"> <a href="#" class="stuff_category"><?=$row_tin['Ten'] ?></a> <span class="stuff_date"><?=date('M',strtotime($row_tin['Ngay'])) ?> <strong><?=date('d',strtotime($row_tin['Ngay'])) ?></strong></span>
        <h2><a href="#"><?=$row_tin['TieuDe'] ?></a></h2>
        <img class="img-center" src="<?=$row_tin['TieuDe'] ?>" alt="">
        <p><?=$row_tin['TomTat'] ?></p>
        <div id="noidung"><?=$row_tin['NoiDung'] ?></div>
        <div class="singlepage_pagination"> <a class="previous_btn" href="#">Previous</a> <a class="next_btn" href="#">Next</a> </div>
        <div class="social_area wow fadeInLeft">
            <ul>
                <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
            </ul>
        </div>
        <div class="author">
            <div id="tincuhon">
                <?php $tincuhon = $t->TinCuCungLoai($idTin,6); ?>
                <h3 class="caption">Tin tiếp theo</h3>
                <?php while($row_kq = $tincuhon->fetch_assoc()) { ?>
                    <h4><a href="#"><?=$row_kq['TieuDe']; ?></a></h4>
                <?php } ?>
            </div>
            <a href="#"><img src="../images/100x100.jpg" alt=""></a>
            <div class="author_details">
                <h3><a href="#">Author Name</a></h3>
                <p>About Author Content lobortis. Proin ut nibh quis felis auctor ornare. Cras ultricies, nibh at mollis faucibus, justo eros porttitor mi, quis auctor lectus arcu sit amet nunc. Vivamus gravida vehicula arcu, vitae vulputate augue lacinia faucibus</p>
            </div>
        </div>
    </div>
</div>