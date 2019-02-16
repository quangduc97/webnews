<?php
$row = null;
$idTL = $_GET['idTL'];
settype($idTL, "int");
$kq = $qt->TheLoai_ChiTiet($idTL);
if($kq) $row = $kq->fetch_assoc();

if(isset($_POST['TenTL'])) {
    $TenTL = $_POST['TenTL'];
    $TenTL_KD = $_POST['TenTL_KhongDau'];
    $ThuTu = $_POST['ThuTu'];
    $AnHien = $_POST['AnHien'];
    $qt ->TheLoai_Sua($idTL, $TenTL, $TenTL_KD, $ThuTu, $AnHien);
    echo "<script>document.location='index.php?p=theloai_ds';</script>";
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
                    CHỈNH SỬA THỂ LOẠI
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
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="TenTL">Tên thể loại</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="TenTL" name="TenTL" class="form-control" placeholder="Nhập tên thể loại" maxlength="20" minlength="3" required value="<?=$row['TenTL'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="TenTL_KhongDau">Tên thể loại không dấu</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="TenTL_KhongDau" name="TenTL_KhongDau" class="form-control" placeholder="Tên thể loại không dấu" value="<?=$row['TenTL_KhongDau'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="ThuTu">Thứ tự</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="ThuTu" name="ThuTu" class="form-control" placeholder="Nhập vào thứ tự xuất hiện" required min="1" max="1000" value="<?=$row['ThuTu'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Ẩn hiện</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="radio" id="AnHien_1" name="AnHien" <?=($row['AnHien'])==1? "checked":"" ?> value="1"> <label for="AnHien_1">Ẩn</label>
                                    <input type="radio" id="AnHien_0" name="AnHien" value="0" <?=($row['AnHien'])==0? "checked":"" ?>> <label for="AnHien_0">Hiện</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">CẬP NHẬT THỂ LOẠI</button>
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