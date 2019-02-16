<?php
$tukhoa = $_GET['tukhoa'];
$pageSize = 5; //Số tin sẽ hiện trong 1 trang
if (isset($_GET['pageNum'])) $pageNum = $_GET['pageNum']; //trang user xem
settype($pageNum, "int");
if ($pageNum<=0) $pageNum = 1;
$totalRows = 0;
$tin = $t->TimKiem($tukhoa,$totalRows, $pageNum, $pageSize); //chỉ lấy 1 trang thứ $pageNum vs $pageSize record
//var_dump($tin->fetch_assoc());

?>

<style>
    #tintrongloai .stuff_article_inner {
        margin-bottom: 15px;
        padding-right: 20px;
        text-align: justify;
    }
    #tintrongloai .stuff_article_inner img {
        width: 180px;
        height: 150px;
        margin: 10px 15px 0px -70px;
    }
    #tintrongloai .stuff_article_inner h2 {
        font-size: 1.3em;
        font-weight: 700;
        line-height: 150%;
    }
    #tintrongloai .stuff_date {
        position: relative;
        z-index: 1;
        opacity: 0.8;
    }
</style>

<div id="tintrongloai">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a> </li>
        <li class="breadcrumb-item"><a href="#">Tìm kiếm</a> </li>
        <li class="breadcrumb-item active"><?=$tukhoa; ?></li>
    </ol>
    <?php while ($row_tin = $tin->fetch_assoc()) { ?>
        <div class="stuff_article_inner"> <span class="stuff_date"><?=date('M', strtotime($row_tin['Ngay'])) ?> <strong><?=date('d', strtotime($row_tin['Ngay'])) ?></strong></span>
            <img src="<?=$row_tin['urlHinh']; ?>" align="left" onerror="this.src='/news/defaultImg.jpg'">
            <h2><a href="index.php?p=detail&idTin=<?=$row_tin['idTin']; ?>"><?=$row_tin['TieuDe'] ?></a></h2>
            <p><?=$row_tin['TomTat'] ?></p>
        </div>
    <?php } ?>
</div>


<div class="slideInLeft animated">
    <?=$t->pageList("index.php?p=search&tukhoa=$tukhoa", $totalRows, $pageNum, $pageSize, $offset=3); ?>
</div>
