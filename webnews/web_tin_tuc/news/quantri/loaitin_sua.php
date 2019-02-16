<?php
$row = null;
$idLT = $_GET['idLT'];
settype($idLT, "int");
$kq = $qt->LoaiTin_ChiTiet($idLT);
if($kq) $row = $kq->fetch_assoc();

if(isset($_POST['Ten'])) {
    $Ten = $_POST['Ten'];
    $Ten_KD = $_POST['Ten_KhongDau'];
    $ThuTu = $_POST['ThuTu'];
    $AnHien = $_POST['AnHien'];
    $idTL = $_POST['idTL'];
    $qt ->LoaiTin_Sua($Ten, $Ten_KD, $ThuTu, $AnHien, $idTL, $idLT);
    echo "<script>document.location='index.php?p=loaitin_ds';</script>";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!-- Horizontal Layout -->
<div class="row clearfix">
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 center-block" style="float:none">
        <div class="card">
            <div class="header">
                <h2>
                    CHỈNH SỬA LOẠI TIN
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form class="form-horizontal" METHOD="post" action="">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="Ten">Tên</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="Ten" name="Ten" class="form-control" placeholder="Nhập tên loại tin" maxlength="20" minlength="3" required value="<?=$row['Ten']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="Ten_KhongDau">Tên không dấu</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="Ten_KhongDau" name="Ten_KhongDau" class="form-control" placeholder="Tên loại tin không dấu" value="<?=$row['Ten_KhongDau']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="ThuTu">Thứ tự</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="ThuTu" name="ThuTu" class="form-control" placeholder="Nhập vào thứ tự xuất hiện" required min="1" max="1000" value="<?=$row['ThuTu']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Ẩn hiện</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="radio" id="AnHien_1" name="AnHien" <?=($row['AnHien'] == 1) ?"checked":""?> value="1"> <label for="AnHien_1">Ẩn</label>
                                    <input type="radio" id="AnHien_0" name="AnHien" value="0" <?=($row['AnHien'] == 0) ?"checked":""?>> <label for="AnHien_0">Hiện</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Thể loại</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <?php $listTL = $qt->ListTheLoai();?>
                                    <select class="form-control show-tick" name="idTL" id="idTL">
                                        <option value="0">-- Chọn Thể Loại --</option>
                                        <?php while ($r = $listTL->fetch_assoc()) {?>
                                            <?php if($r['idTL'] == $row['idTL']) { ?>
                                            <option value="<?=$r['idTL']?>" selected><?=$r['TenTL']?></option>
                                            <?php } else { ?>
                                            <option value="<?=$r['idTL']?>"><?=$r['TenTL']?></option>
                                            <?php } ?>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">CẬP NHẬT LOẠI TIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Horizontal Layout -->
</body>
</html>