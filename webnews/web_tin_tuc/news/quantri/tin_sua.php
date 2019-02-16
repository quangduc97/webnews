<?php
$row = null;
$idTin = $_GET['idTin'];
settype($idTin, "int");
$kq = $qt->Tin_ChiTiet($idTin);
if($kq) $row = $kq->fetch_assoc();

if(isset($_POST['TieuDe'])) {
    $TieuDe = $_POST['TieuDe'];
    $TieuDe_KD = $_POST['TieuDe_KhongDau'];
    $TomTat = $_POST['TomTat'];
    $Ngay = $_POST['Ngay'];                                        //hiện đang là d/m/Y
    $Ng = DateTime::createFromFormat('d/m/Y', $Ngay);       //tạo obj dạng ngày
    $Ngay = $Ng->format('Y-m-d');                           //đổi thành dạng Y-m-d
    $AnHien = $_POST['AnHien'];
    $TinNoiBat = $_POST['TinNoiBat'];
    $idTL = $_POST['idTL'];
    $idLT = $_POST['idLT'];
    $urlHinh = $_POST['urlHinh'];
    $NoiDung = $_POST['NoiDung'];

    $qt->Tin_Sua($TieuDe, $TieuDe_KD, $TomTat, $Ngay, $AnHien, $TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT, $idTin);
    echo "<script>document.location='index.php?p=tin_ds';</script>";
    exit();
}
?>

<div class="row clearfix">
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin:auto; float:none">
        <div class="card">
            <div class="header">
                <h2>CHỈNH SỬA TIN</h2>
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
                <form id="form_validation" method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="TieuDe" required minlength="10" maxlength="100" value="<?=$row['TieuDe'] ?>">
                            <label class="form-label">Tiêu đề</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="TieuDe_KhongDau" value="<?=$row['TieuDe_KhongDau'] ?>">
                            <label class="form-label">Tiêu đề không dấu</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="urlHinh" id="urlHinh" class="form-control" value="<?=$row['urlHinh'] ?>">
                                <label class="form-label">url Hình</label>
                                <input type="button" onclick="selectFileWithCKFinder('urlHinh')" value="Choose Image" />
                            </div>
                        </div>
                        <div class="form-line">
                            <textarea name="TomTat" cols="30" rows="5" class="form-control no-resize"><?=$row['TomTat'] ?></textarea>
                            <label class="form-label">Tóm tắt</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <input type="radio" name="AnHien" id="AnHien_0" value="0" <?=($row['AnHien'] == 0) ?"checked":"" ?>>
                                <label for="AnHien_0">Hiện</label>
                                <input type="radio" name="AnHien" id="AnHien_1" value="1" <?=($row['AnHien'] == 1) ?"checked":"" ?>>
                                <label for="AnHien_1">Ẩn</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <input type="radio" name="TinNoiBat" id="TinNoiBat_0" value="0" <?=($row['TinNoiBat'] == 0) ?"checked":"" ?>>
                                <label for="TinNoiBat_0">Tin thường</label>
                                <input type="radio" name="TinNoiBat" id="TinNoiBat_1" value="1" <?=($row['TinNoiBat'] == 1) ?"checked":"" ?>>
                                <label for="TinNoiBat_1" class="m-1-20">Tin nổi bật</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="datepicker" name="Ngay" value="<?=date('d/m/Y', strtotime($row['Ngay'])) ?>">
                                    <label class="form-label">Ngày đăng</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <?php $listTL = $qt->ListTheLoai(); ?>
                                <select class="form-control show-tick" name="idTL" id="idTL">
                                    <option value="0">-- Chọn thể loại --</option>
                                    <?php while($r = $listTL->fetch_assoc()) { ?>
                                    <?php if($r['idTL'] == $row['idTL']) { ?>
                                    <option value="<?=$row['idTL'] ?>" selected><?=$r['TenTL'] ?></option>
                                    <?php } else { ?>
                                    <option value="<?=$r['idTL'] ?>"><?=$r['TenTL'] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <?php $listLT = $qt->LoaiTinTrongTheLoai($row['idTL']); ?>
                                <select class="form-control show-tick" name="idLT" id="idLT">
                                    <option value="0">-- Chọn loại tin --</option>
                                    <?php while($r = $listLT->fetch_assoc()) { ?>
                                        <?php if($r['idLT'] == $row['idLT']) { ?>
                                        <option value="<?=$r['idLT']?>" selected><?=$r['Ten']?></option>
                                    <?php } else { ?>
                                        <option value="<?=$r['idLT']?>"><?=$r['Ten']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="NoiDung" cols="30" rows="10" class="form-control" required><?=$row['NoiDung']?></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">CHỈNH SỬA TIN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<script src="plugins/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function(e) {
        CKEDITOR.replace('NoiDung',
            {language:'vi', skin:'kama',
                filebrowserImageBrowseUrl: 'plugins/ckfinder/ckfinder.html?Type=Images',
                filebrowserImageUploadUrl: 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',});
        CKEDITOR.config.height = 300;
    });
</script>

<link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<script src="plugins/autosize/autosize.js"></script>
<script src="plugins/momentjs/moment.js"></script>
<script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script>
    $(document).ready(function(e) {
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/Y', clearButton: true,
            weekStart: 1, time: false
        });
    });
</script>

<script>
    $(document).ready(function(e) {
        $("#idTL").change(function(){
            var idTL=$(this).val();
            $("#idLT").load("tintuc_layloaitin.php?idTL="+ idTL);
        });
    });
</script>

<script src="plugins/ckfinder/ckfinder.js"></script>

<script type="text/javascript">
    function selectFileWithCKFinder(elementId) {
        CKFinder.popup( {
            chooseFiles: true, with: 800, height: 600,
            onInit: function( finder) {
                finder.on('files: choose', function( evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( elementId);
                    output.value= file.getUrl();
                });
                finder.on('file:choose:resizedImage', function( evt) {
                    var output = document.getElementById( elementId);
                    output.value = evt.data.resizedUrl;
                });
            }
        });
    }
</script>

<script>
    $(document).ready(function(e) {
        $("#form_validation").submit(function() {
            if ($("#idTL").val() == 0) {
                alert("Bạn ơi! Chưa chọn thể loại mà");
                return false;
            }
        });
    });
</script>