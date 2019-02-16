<?php
require "../class/goc.php";
class quantritin extends goc {
    function thongtinuser($u, $p) {
        $u = $this->db->escape_string($u);
        $p = $this->db->escape_string($p);
        $p = md5($p);
        echo $sql = "SELECT * FROM users WHERE username='$u' AND password = '$p'";
        $kq = $this->db->query($sql);
        if($kq->num_rows == 0) return FALSE;
        else return $kq->fetch_assoc();
    }

    function checkLogin() {
        session_start();
        if(!isset($_SESSION['login_id'])) {
            $_SESSION['error'] = "Bạn chưa đăng nhập";
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header("location: login.php");
        } elseif ($_SESSION['login_level'] != 1) {
            $_SESSION['error'] = "Bạn không có quyền xem trang này";
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header("location: login.php");
            exit();
        }
    }

    function ListTheLoai() {
        $sql = "SELECT idTL,TenTL,ThuTu,AnHien,TenTL_KhongDau FROM theloai ORDER BY ThuTu";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TheLoai_Them($TenTL, $TenTL_KD, $ThuTu, $AnHien) {
        $TenTL = $this->db->escape_string(trim(strip_tags($TenTL)));
        $TenTL_KD = $this->db->escape_string(trim(strip_tags($TenTL_KD)));

        if($TenTL_KD == "") $TenTL_KD = $this->changeTitle($TenTL);
        settype($ThuTu,"int");
        settype($AnHien,"int");

        $sql = "INSERT INTO theloai SET TenTL='$TenTL', TenTL_KhongDau='$TenTL_KD', ThuTu=$ThuTu, AnHien=$AnHien";
        //$sql = "INSERT INTO theloai (TenTL, TenTL_KhongDau, ThuTu, AnHien) VALUES ('$TenTL', '$TenTL_KD', $ThuTu, $AnHien)";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function changeTitle($str) {
        $str = $this->stripUnicode($str);
        $str = $this->stripSpecial($str);

        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        return $str;
    }

    function stripSpecial($str) {
        $arr = array(",", "$", "!", "?", "&", "''", '""', "+");
        $str = str_replace($arr, "", $str);
        $str = trim($str);

        while (strpos($str, "  ") > 0)   $str = str_replace("  ", " ", $str);
        $str = str_replace(" ", "-", $str);
        return $str;
    }

    function stripUnicode($str) {
        if(!$str) return false;
        $unicode = array(
            'a' => 'á|à|ạ|ả|ã|ă|ắ|ằ|ặ|ẳ|ẵ|â|ấ|ầ|ậ|ẩ|ẫ',
            'A' => 'Á|À|Ạ|Ả|Ã|Ă|Ắ|Ằ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ',
            'd' => 'đ', 'D' => 'Đ',
            'e' => 'é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ',
            'E' => 'É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ệ|Ể|Ễ',
            'i' => 'í|ì|ị|ỉ|ĩ', 'I' => 'Í|Ì|Ị|Ỉ|Ĩ',
            'o' => 'ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ',
            'O' => 'Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ộ|Ổ|Ỗ',
            'u' => 'ú|ù|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
            'U' => 'Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ự|Ử|Ữ',
            'Y' => 'Ý|Ỳ|Ỵ|Ỷ|Ỹ', 'y' => 'y|ý|ỳ|ỵ|ỷ|ỹ'
        );

        foreach ($unicode as $khongdau=>$codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $codau);
        }
        return $str;
    }

    function TheLoai_ChiTiet($idTL) {
        $sql = "SELECT idTL, TenTL, ThuTu, AnHien, TenTL_KhongDau FROM theloai WHERE idTL='$idTL'";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TheLoai_Sua($idTL, $TenTL, $TenTL_KD, $ThuTu, $AnHien) {
        settype($idTL, "int");
        $TenTL = $this->db->escape_string(trim(strip_tags($TenTL)));
        $TenTL_KD = $this->db->escape_string(trim(strip_tags($TenTL_KD)));

        if($TenTL_KD == "") $TenTL_KD = $this->changeTitle($TenTL);
        settype($ThuTu, "int");
        settype($AnHien, "int");

        echo $sql = "UPDATE theloai SET TenTL='$TenTL', TenTL_KhongDau='$TenTL_KD', ThuTu='$ThuTu', AnHien='$AnHien' WHERE idTL='$idTL'";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function TheLoai_Xoa($idTL) {
        settype($idTL, "int");
        $sql = "DELETE FROM theloai WHERE idTL='$idTL'";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function ListLoaiTin() {
        $sql = "SELECT idLT, Ten, loaitin.ThuTu, loaitin.AnHien, Ten_KhongDau, TenTL FROM loaitin, theloai
                WHERE loaitin.idTL=theloai.idTL
                ORDER BY loaitin.ThuTu";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function LoaiTin_Them($Ten, $Ten_KD, $ThuTu, $AnHien, $idTL) {
        $Ten = $this->db->escape_string(trim(strip_tags($Ten)));
        $Ten_KD = $this->db->escape_string(trim(strip_tags($Ten_KD)));

        if($Ten_KD == "") $Ten_KD = $this->changeTitle($Ten);
        settype($ThuTu,"int");
        settype($AnHien,"int");
        settype($idTL,"int");

        $sql = "INSERT INTO loaitin SET Ten='$Ten', Ten_KhongDau='$Ten_KD', ThuTu=$ThuTu, AnHien=$AnHien, idTL=$idTL";
        //$sql = "INSERT INTO theloai (TenTL, TenTL_KhongDau, ThuTu, AnHien) VALUES ('$TenTL', '$TenTL_KD', $ThuTu, $AnHien)";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function LoaiTin_ChiTiet($idLT) {
        $sql = "SELECT idLT, Ten, ThuTu, AnHien, Ten_KhongDau, idTL FROM loaitin WHERE idLT='$idLT'";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function LoaiTin_Sua($Ten, $Ten_KD, $ThuTu, $AnHien, $idTL, $idLT) {
        $Ten = $this->db->escape_string(trim(strip_tags($Ten)));
        $Ten_KD = $this->db->escape_string(trim(strip_tags($Ten_KD)));

        if($Ten_KD == "") $Ten_KD = $this->changeTitle($Ten);
        settype($ThuTu,"int");
        settype($AnHien,"int");
        settype($idTL,"int");
        settype($idLT,"int");

        $sql = "UPDATE loaitin SET Ten='$Ten', Ten_KhongDau='$Ten_KD', ThuTu=$ThuTu, AnHien=$AnHien, idTL=$idTL WHERE idLT=$idLT";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function LoaiTin_Xoa($idLT) {
        settype($idLT, "int");
        $sql = "DELETE FROM loaitin WHERE idLT=$idLT";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function ListTin() {
        $sql = "SELECT idTin, TieuDe, TomTat, tin.AnHien, TinNoiBat, Ngay, SoLanXem, TenTL, Ten FROM tin, loaitin, theloai
                WHERE tin.idLT=loaitin.idLT AND loaitin.idTL=theloai.idTL
                ORDER BY idTin Desc";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function Tin_Them($TieuDe, $TieuDe_KD, $TomTat, $Ngay, $AnHien, $TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT) {
        $TieuDe = $this->db->escape_string(trim(strip_tags($TieuDe)));
        $TieuDe_KD = $this->db->escape_string(trim(strip_tags($TieuDe_KD)));

        if($TieuDe_KD == "") $TieuDe_KD = $this->changeTitle($TieuDe);
        settype($AnHien,"int");
        settype($TinNoiBat,"int");
        settype($idTL,"int");
        settype($idLT,"int");

        $sql = "INSERT INTO tin SET TieuDe='$TieuDe', TomTat='$TomTat',
                TieuDe_KhongDau='$TieuDe_KD', Ngay='$Ngay', AnHien=$AnHien,
                TinNoiBat=$TinNoiBat, urlHinh='$urlHinh', NoiDung='$NoiDung', SoLanXem=0,
                idTL=$idTL, idLT=$idLT";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function LoaiTinTrongTheLoai($idTL) {
        $sql = "SELECT idLT, Ten FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function Tin_ChiTiet($idTin) {
        $sql = "SELECT * FROM tin WHERE idTin=$idTin";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function Tin_Sua($TieuDe, $TieuDe_KD, $TomTat, $Ngay, $AnHien, $TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT, $idTin) {
        $TieuDe = $this->db->escape_string(trim(strip_tags($TieuDe)));
        $TieuDe_KD = $this->db->escape_string(trim(strip_tags($TieuDe_KD)));

        if($TieuDe_KD == "") $TieuDe_KD = $this->changeTitle($TieuDe);
        settype($AnHien,"int");
        settype($TinNoiBat,"int");
        settype($idTL,"int");
        settype($idLT,"int");

        $sql = "UPDATE tin SET TieuDe='$TieuDe', TieuDe_KhongDau='$TieuDe_KD', TomTat='$TomTat', Ngay='$Ngay',
                urlHinh='$urlHinh', NoiDung='$NoiDung', AnHien=$AnHien, TinNoiBat=$TinNoiBat, idTL=$idTL,
                idLT=$idLT WHERE idTin=$idTin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }

    function Tin_Xoa($idTin) {
        settype($idTin, "int");
        $sql = "DELETE FROM tin WHERE idTin=$idTin";
        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
    }


}
?>
