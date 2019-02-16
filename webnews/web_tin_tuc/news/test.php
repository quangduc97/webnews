<?php
$idLT=$_GET['idLT'];
settype($idLT,"int");
$tin = $t->TinTrongLoai($idLT); //chỉ lấy 1 trang thứ $pageNum vs $pageSize record
var_dump($tin->fetch_assoc());
$loaitin = $t->ChiTietLoaiTin($idLT);
$row_loaitin = $loaitin->fetch_assoc();
?>

<div>
    <h1>Hello</h1>
</div>
